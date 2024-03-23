<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\m_user;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class user extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('id')) {
            return redirect('/')->with('alert', 'Silahkan Login Terlebih Dahulu!');
        };
        $judul = "Data User";
        $divisi = DB::table('divisi')
            ->get();
        return view('v_user', compact('judul'), [
            'divisi' => $divisi,
        ]);
    }
    public function json()
    {
        $data = DB::table('users')
            ->join('divisi', 'users.id_divisi', '=', 'divisi.id_divisi')
            ->get();

        return Datatables::of($data)
            ->addColumn('aksi', function ($data) {
                return
                    '<button id="edit" data-id="' . $data->id . '" class="btn btn-primary">Edit</button>
                    <button id="delete" data-id="' . $data->id . '" class="btn btn-danger">Delete</button>';
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $post = new m_user();
        $post->nama_user = $request->nama_user;
        $post->name = $request->username;
        $post->password = bcrypt($request->password);
        $post->hak_akses = $request->hak_akses;
        $post->id_divisi = $request->id_divisi;
        $post->save();

        $data = [$post];
        return response()->json($data);
    }
    public function edit(Request $request)
    {
        $get = DB::table('users')
            ->where('id', $request->id)
            ->first();
        //->first() = hanya menampilkan satu saja dari hasil query
        //->get() = returnnya berbentuk array atau harus banyak data
        return response()->json($get);
    }

    public function update(Request $request, $id)
    {

        $post = m_user::findOrFail($id);
        $post->nama_user = $request->nama_user;
        $post->name = $request->username;
        if ($request->password) {
            $post->password = bcrypt($request->password);
        }
        $post->hak_akses = $request->hak_akses;
        $post->id_divisi = $request->id_divisi;
        $post->save();

        $data = [$post];
        return response()->json($data);
    }
    public function destroy($id)
    {
        $post = m_user::findOrFail($id);
        $post->delete();

        return response()->json($post);
    }
}
