<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MarketingController extends Controller
{
    public function index()
    {
        $users = User::all();
        $outlets = Cabang::pluck('nama_cabang', 'id');
        return view('marketing.index', compact('users', 'outlets'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $outlets = Cabang::pluck('nama_cabang', 'id');
        return view('marketing.edit', compact('user', 'outlets'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'Outlet' => ['required', 'string'],
            'Target' => ['required', 'integer', 'min:0'],
            'photo' => ['nullable', 'image', 'max:1024'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('marketing.index')
                ->withErrors($validator)
                ->withInput();
        }

        $photo = $user->photo;

        if ($request->hasFile('photo')) {
            Storage::delete("public/photos/$photo");
            $photo = $request->file('photo')->store('public/photos');
            $photo = basename($photo);
        }

        $user->update([
            'name' => $request->input('name'),
            'Outlet' => $request->input('Outlet'),
            'Target' => $request->input('Target'),
            'photo' => $photo,
        ]);
        return redirect('/marketing')->with('Sukses', 'Data Berhasil diupdate');
    }
}
