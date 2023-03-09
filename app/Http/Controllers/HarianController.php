<?php

namespace App\Http\Controllers;

use App\Models\Harian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

class HarianController extends Controller
{

    public function index(Request $request)
    {
        // Get the total Realisasi Cair for the selected user
        $total = DB::table('harian')->where('user_id', $request->input('user_id'))
            ->sum('Realisasi_Cair')
            + DB::table('harian')->where('user_id', $request->input('user_id'))
            ->sum('Pencairan_TopUp');

        // Get a list of all users to populate the dropdown
        $users = DB::table('users')->pluck('name', 'id');
        $Outlet = DB::table('users')->pluck('Outlet', 'id');

        $totalrc = DB::table('harian')->where('user_id', $request->input('user_id'))
        ->sum('Realisasi_Cair');
        $totalpt = DB::table('harian')->where('user_id', $request->input('user_id'))
        ->sum('Pencairan_TopUp');

        // Get the selected user ID from the dropdown, or default to the currently logged in user
        $userId = $request->input('user_id');

        // Retrieve harian data for the selected user
        $harian = DB::table('harian')->where('user_id', $userId)->get();

        // Pass the retrieved data to the view
        return view('harian.index', compact('harian', 'total', 'users', 'userId', 'Outlet', 'totalrc', 'totalpt'));
    }

    public function create(Request $request)
    {
        // Parse the input value to extract the name and Outlet
        $input = $request->input('info');
        $parts = explode(',', $input);
        $name = trim($parts[0]);
        $Outlet = trim($parts[1]);

        // Get the user ID based on the user's name
        $user_id = DB::table('users')->where('name', $name)->value('id');

        // Create a new Harian record and set the user ID and Outlet
        $harian = new Harian();
        $harian->user_id = $user_id;
        $harian->name = $name;
        $harian->Outlet = $Outlet;
        $harian->fill($request->all());
        $harian->save();

        return redirect('/harian')->with('Sukses', 'Data berhasil di input!');
    }


    public function edit($harian)
    {
        $harian = \App\Models\Harian::find($harian);
        return view('harian.edit', ['harian' => $harian]);
    }

    public function update(Request $request, $harian)
    {
        $harian = \App\Models\Harian::find($harian);
        $harian->update($request->all());
        return redirect('/harian')->with('Sukses', 'Data Berhasil diupdate');
    }

    public function delete($harian)
    {
        $harian = \App\Models\Harian::find($harian);
        $harian->delete();
        return redirect('/harian')->with("Sukses", 'Data berhasil dihapus');
    }

    public function harian()
    {
        $user = Auth::all();

        $name = [];

        foreach ($user as $nn) {
            $name[] = $nn->name;
        }
        return view('harian.index', ['harian' => $user, 'name' => $name]);
    }

    public function user()
    {
        $user = Auth::user()->name;
        return view('harian.index', ['user' => $user]);
    }

    public function keseluruhan()
    {
        $keseluruhan = \App\Models\Harian::all();
        return view('keseluruhan.index', ['keseluruhan' => $keseluruhan]);
    }
    public function editkeseluruhan($keseluruhan)
    {
        $keseluruhan = \App\Models\Harian::find($keseluruhan);
        return view('keseluruhan.edit', ['keseluruhan' => $keseluruhan]);
    }
}
