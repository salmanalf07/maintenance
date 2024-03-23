<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\m_trouble;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class trouble extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('id')) {
            return redirect('/')->with('alert', 'Silahkan Login Terlebih Dahulu!');
        };
        $judul = "Perbaikan Mesin";
        $divisi = DB::table('divisi')
            ->get();
        return view('v_trouble', compact('judul'), [
            'divisi' => $divisi,
        ]);
    }
    public function json(Request $request)
    {
        $data = DB::table('trouble')
            ->join('divisi', 'trouble.id_divisi', '=', 'divisi.id_divisi')
            ->join('mesin', 'trouble.id_mesin', '=', 'mesin.id_mesin')
            ->select('trouble.*', 'divisi.nama_divisi', 'mesin.id_mesin', 'mesin.mesin');

        if ($request->session()->get("hak_akses") != "User") {
            $data->where('trouble.delete', '!=', "true");
        } else {
            $data->where([
                ['trouble.delete', '!=', "true"],
                ['requester', '=', $request->session()->get("name")],
            ]);
        }
        $data->get();


        return Datatables::of($data)
            ->addColumn('aksi', function ($data) {
                if ($data->status == "Open")
                    return
                        '<select id="hak_akses" style="width:80px" class="btn btn-danger">
                        <option selected value="' . $data->id . '-Open">Open</option>
                        <option value="' . $data->id . '-Onprogress">Onprogress</option>
                        <option value="' . $data->id . '-Waiting">Waiting</option>
                        <option value="' . $data->id . '-Closed">Closed</option>
                        </select>
                        <button id="delete" data-id="' . $data->id . '" class="btn btn-danger">Delete</button>';
                if ($data->status == "Onprogress")
                    return
                        '<select id="hak_akses" class="btn btn-warning">
                        <option value="' . $data->id . '-Open">Open</option>
                        <option selected value="' . $data->id . '-Onprogress">Onprogress</option>
                        <option value="' . $data->id . '-Waiting">Waiting</option>
                        <option value="' . $data->id . '-Closed">Closed</option>
                        </select>
                        <button id="delete" data-id="' . $data->id . '" class="btn btn-danger">Delete</button>';
                if ($data->status == "Waiting")
                    return
                        '<select id="hak_akses" class="btn btn-secondary">
                        <option value="' . $data->id . '-Open">Open</option>
                        <option value="' . $data->id . '-Onprogress">Onprogress</option>
                        <option selected value="' . $data->id . '-Waiting">Waiting</option>
                        <option value="' . $data->id . '-Closed">Closed</option>
                        </select>
                        <button id="delete" data-id="' . $data->id . '" class="btn btn-danger">Delete</button>';
                return
                    '<select id="hak_akses" class="btn btn-succes">
                    <option value="' . $data->id . '-Open">Open</option>
                    <option value="' . $data->id . '-Onprogress">Onprogress</option>
                    <option value="' . $data->id . '-Waiting">Waiting</option>
                    <option selected value="' . $data->id . '-Closed">Closed</option>
                    </select>
                    <button id="delete" data-id="' . $data->id . '" class="btn btn-danger">Delete</button>';
            })
            ->addColumn('aksi_petugas', function ($data) {
                if ($data->status == "Open")
                    return
                        '<select id="hak_akses" style="width:80px" class="btn btn-danger">
                        <option selected value="' . $data->id . '-Open">Open</option>
                        <option value="' . $data->id . '-Onprogress">Onprogress</option>
                        <option value="' . $data->id . '-Waiting">Waiting</option>
                        <option value="' . $data->id . '-Closed">Closed</option>
                        </select>';
                if ($data->status == "Onprogress")
                    return
                        '<select id="hak_akses" class="btn btn-warning">
                        <option value="' . $data->id . '-Open">Open</option>
                        <option selected value="' . $data->id . '-Onprogress">Onprogress</option>
                        <option value="' . $data->id . '-Waiting">Waiting</option>
                        <option value="' . $data->id . '-Closed">Closed</option>
                        </select>';
                if ($data->status == "Waiting")
                    return
                        '<select id="hak_akses" class="btn btn-secondary">
                        <option value="' . $data->id . '-Open">Open</option>
                        <option value="' . $data->id . '-Onprogress">Onprogress</option>
                        <option selected value="' . $data->id . '-Waiting">Waiting</option>
                        <option value="' . $data->id . '-Closed">Closed</option>
                        </select>';
                return
                    '<select id="hak_akses" class="btn btn-succes">
                    <option value="' . $data->id . '-Open">Open</option>
                    <option value="' . $data->id . '-Onprogress">Onprogress</option>
                    <option value="' . $data->id . '-Waiting">Waiting</option>
                    <option selected value="' . $data->id . '-Closed">Closed</option>
                    </select';
            })
            ->addColumn('id_trouble', function ($data) {
                return
                    "TR" . date("y", strtotime($data->created_at)) . date("m", strtotime($data->created_at)) . sprintf('%04d', $data->id_trouble);
            })
            ->rawColumns(['aksi', "id_trouble", 'aksi_petugas'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $record = DB::table('trouble')
            ->latest('id')
            ->first();
        if ($record === null) {
            $id_trouble = 1;
        } else {
            if (date("Y-m", strtotime($record->created_at)) != date("Y-m")) {
                $id_trouble = 1;
            } else {
                $id_trouble = $record->id_trouble + 1;
            }
        }

        $post = new m_trouble();
        $post->id_trouble = $id_trouble;
        $post->requester = $request->requester;
        $post->tgl_perbaikan = date('Y-m-d', strtotime($request->datepicker1));
        $post->id_divisi = $request->id_divisi;
        $post->id_mesin = $request->id_mesin;
        $post->judul = $request->judul;
        $post->keterangan = $request->keterangan;
        $post->status = "Open";
        $post->delete = "";
        $post->save();

        $data = [$post];
        return response()->json($data);
    }

    public function mesin(Request $request)
    {
        $data = DB::table('mesin')
            ->where('id_divisi', $request->id_divisi)
            ->get();

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {

        $post = m_trouble::findOrFail($id);
        $post->status = $request->status;
        $post->save();

        $data = [$post];
        return response()->json($data);
    }
    public function destroy($id)
    {
        $post = m_trouble::findOrFail($id);
        $post->delete = "true";
        $post->save();

        return response()->json();
    }

    public function spk($id)
    {
        $data = DB::table('trouble')
            ->join('divisi', 'trouble.id_divisi', '=', 'divisi.id_divisi')
            ->join('mesin', 'trouble.id_mesin', '=', 'mesin.id_mesin')
            ->select('trouble.*', 'divisi.nama_divisi', 'mesin.kode_mesin', 'mesin.mesin', 'mesin.jenis_mesin')
            ->where('id_trouble', $id)
            ->first();
        $p_check = DB::table('point_check')
            ->whereIn('id_check', str_split($data->p_check))
            ->get();

        return view('v_spk', [
            'data' => $data,
            'p_check' => $p_check,
        ]);
    }
}
