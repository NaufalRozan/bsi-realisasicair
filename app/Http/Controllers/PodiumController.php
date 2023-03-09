<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PodiumController extends Controller
{
    public function index()
    {
        $users = DB::table('users')
            ->join('harian', 'harian.user_id', '=', 'users.id')
            ->select(
                'users.name',
                'users.Outlet',
                'users.Target',
                'users.photo',
                DB::raw('(SUM(harian.Realisasi_Cair) + SUM(harian.Pencairan_TopUp)) as total2'),
                DB::raw('((SUM(harian.Realisasi_Cair) + SUM(harian.Pencairan_TopUp)) / Target) * 100 as percent')
            )
            ->groupBy('users.id')
            ->orderByDesc('percent')
            ->take(3)
            ->get();

        return view('podium.index', compact('users'));
    }
}
