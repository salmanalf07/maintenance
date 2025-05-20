<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class login extends Controller
{
    public function index()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect('/dashboard');
        }
        return view('v_login');
    }

    public function login(Request $request)
    {
        $get = DB::table('users')
            ->where('name', $request->input('name'))
            ->first();

        if ($get) {
            $data = [
                'name'     => $request->input('name'),
                'password'  => $request->input('password'),
                'id'  => $get->id,
                'hak_akses'  => $get->hak_akses,
            ];

            Auth::attempt($data);

            if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
                //Login Success
                // Menyimpan data yang diperlukan di session
                $request->session()->put('nama_user', $get->nama_user);  // Simpan nama_user ke dalam session
                $request->session()->put('hak_akses', $get->hak_akses);  // Simpan hak akses ke dalam session
                $request->session()->put('id', $get->id);

                return redirect()->action([home::class, 'index']);
            } else {
                return redirect('/')->with('alert', 'Email atau Password anda salah!');
            }
        }
        return redirect('/')->with('alert', 'Anda belum terdaftar!');
    }
    public function logout(Request $request)
    {
        Auth::logout(); // menghapus session yang aktif
        $request->session()->flush();
        return redirect('/');
    }
}
