<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class home extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('id')) {
            $judul = "Dashboard";
            return view('v_dashboard', [
                'judul' => $judul,
            ]);
        } else {
            return redirect('/')->with('alert', 'Silahkan Login Terlebih Dahulu!');
        }
    }
}
