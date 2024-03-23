<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_mesin;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class mesin extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('id')) {
            $judul = "Daftar Mesin";
            $divisi = DB::table('divisi')
                ->get();
            $jenis_mesin = DB::table('jenis_mesin')
                ->get();
            return view('v_mesin', [
                'judul' => $judul,
                'divisi' => $divisi,
                'jenis_mesin' => $jenis_mesin,
            ]);
        } else {
            return redirect('/')->with('alert', 'Silahkan Login Terlebih Dahulu!');
        }
    }

    public function json()
    {
        $data = DB::table('mesin')
            ->join('divisi', 'mesin.id_divisi', '=', 'divisi.id_divisi')
            ->select('mesin.*', 'divisi.nama_divisi')
            ->get();

        return Datatables::of($data)
            ->addColumn('aksi', function ($data) {
                return
                    '<button id="edit" data-id="' . $data->id_mesin . '" class="btn btn-primary">Edit</button>
                    <button id="delete" data-id="' . $data->id_mesin . '" class="btn btn-danger">Delete</button>';
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $post = new m_mesin();
        $post->no_asset = $request->no_asset;
        $post->kode_mesin = $request->kode_mesin;
        $post->mesin = $request->mesin;
        $post->id_divisi = $request->id_divisi;
        $post->keterangan = $request->keterangan;
        $post->status = $request->status;
        $post->save();

        $data = [$post];
        return response()->json($data);
    }
    public function edit(Request $request)
    {
        $get = DB::table('mesin')
            ->where('id_mesin', $request->id)
            ->first();
        //->first() = hanya menampilkan satu saja dari hasil query
        //->get() = returnnya berbentuk array atau harus banyak data
        return response()->json($get);
    }

    public function update(Request $request, $id)
    {

        $post = m_mesin::findOrFail($id);
        $post->no_asset = $request->no_asset;
        $post->kode_mesin = $request->kode_mesin;
        $post->mesin = $request->mesin;
        $post->id_divisi = $request->id_divisi;
        $post->keterangan = $request->keterangan;
        $post->status = $request->status;
        $post->save();

        $data = [$post];
        return response()->json($data);
    }
    public function destroy($id)
    {
        $post = m_mesin::findOrFail($id);
        $post->delete();

        return response()->json($post);
    }
}
