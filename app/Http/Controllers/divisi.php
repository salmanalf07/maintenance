<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_divisi;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class divisi extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('id')) {
            $judul = "Daftar divisi";
            $divisi = DB::table('divisi')
                ->get();
            return view('v_divisi', [
                'judul' => $judul,
                'divisi' => $divisi,
            ]);
        } else {
            return redirect('/')->with('alert', 'Silahkan Login Terlebih Dahulu!');
        }
    }

    public function json()
    {
        $data = DB::table('divisi')
            ->get();

        return Datatables::of($data)
            ->addColumn('aksi', function ($data) {
                return
                    '<button id="edit" data-id="' . $data->id_divisi . '" class="btn btn-primary">Edit</button>
                    <button id="delete" data-id="' . $data->id_divisi . '" class="btn btn-danger">Delete</button>';
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $post = new m_divisi();
        $post->nama_divisi = $request->nama_divisi;
        $post->save();

        $data = [$post];
        return response()->json($data);
    }
    public function edit(Request $request)
    {
        $get = DB::table('divisi')
            ->where('id_divisi', $request->id)
            ->first();
        //->first() = hanya menampilkan satu saja dari hasil query
        //->get() = returnnya berbentuk array atau harus banyak data
        return response()->json($get);
    }

    public function update(Request $request, $id)
    {

        $post = m_divisi::findOrFail($id);
        $post->nama_divisi = $request->nama_divisi;
        $post->save();

        $data = [$post];
        return response()->json($data);
    }
    public function destroy($id)
    {
        $post = m_divisi::findOrFail($id);
        $post->delete();

        return response()->json($post);
    }
}
