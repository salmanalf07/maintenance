<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_jenisMesin;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class jenis_mesin extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('id')) {
            $judul = "Daftar Jenis Mesin";
            $jenis_mesin = DB::table('jenis_mesin')
                ->get();
            return view('v_jenisMesin', [
                'judul' => $judul,
                'jenis_mesin' => $jenis_mesin,
            ]);
        } else {
            return redirect('/')->with('alert', 'Silahkan Login Terlebih Dahulu!');
        }
    }

    public function json()
    {
        $data = DB::table('jenis_mesin')
            ->get();

        return Datatables::of($data)
            ->addColumn('aksi', function ($data) {
                return
                    '<button id="edit" data-id="' . $data->id_jenisMesin . '" class="btn btn-primary">Edit</button>
                    <button id="delete" data-id="' . $data->id_jenisMesin . '" class="btn btn-danger">Delete</button>';
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $post = new m_jenisMesin();
        $post->jenis_mesin = $request->jenis_mesin;
        $post->save();

        $data = [$post];
        return response()->json($data);
    }
    public function edit(Request $request)
    {
        $get = DB::table('jenis_mesin')
            ->where('id_jenisMesin', $request->id)
            ->first();
        //->first() = hanya menampilkan satu saja dari hasil query
        //->get() = returnnya berbentuk array atau harus banyak data
        return response()->json($get);
    }

    public function update(Request $request, $id)
    {

        $post = m_jenisMesin::findOrFail($id);
        $post->jenis_mesin = $request->jenis_mesin;
        $post->save();

        $data = [$post];
        return response()->json($data);
    }
    public function destroy($id)
    {
        $post = m_jenisMesin::findOrFail($id);
        $post->delete();

        return response()->json($post);
    }
}
