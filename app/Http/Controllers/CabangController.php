<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function index()
    {
        return view('cabang.index');
    }

    public function create(Request $request)
    {
        \App\Models\Cabang::create($request->all());
        return redirect('/cabang')->with('Sukses', 'Outlet telah ditambahkan!');
    }
    
}
