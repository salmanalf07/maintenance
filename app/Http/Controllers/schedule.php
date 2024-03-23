<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\m_schedule;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class schedule extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('id')) {
            return redirect('/')->with('alert', 'Silahkan Login Terlebih Dahulu!');
        };
        $judul = "Schedule Perawatan";
        $divisi = DB::table('divisi')
            ->get();
        return view('v_schedule', compact('judul'), [
            'divisi' => $divisi,
        ]);
    }
    public function json()
    {
        $data = DB::table('schedule')
            ->join('divisi', 'schedule.id_divisi', '=', 'divisi.id_divisi')
            ->join('mesin', 'schedule.id_mesin', '=', 'mesin.id_mesin')
            ->select('schedule.*', 'divisi.nama_divisi', 'mesin.id_mesin', 'mesin.mesin')
            ->where('schedule.delete', '!=', "true")
            ->get();

        return Datatables::of($data)
            ->addColumn('aksi', function ($data) {
                if ($data->status == "Open")
                    return
                        '<select id="hak_akses" style="width:80px" class="btn btn-warning">
                        <option selected value="' . $data->id_schedule . '-Open">Open</option>
                        <option value="' . $data->id_schedule . '-Onprogress">Onprogress</option>
                        <option value="' . $data->id_schedule . '-Waiting">Waiting</option>
                        <option value="' . $data->id_schedule . '-Closed">Closed</option>
                        </select>
                <button id="delete" data-id="' . $data->id_schedule . '" class="btn btn-danger">Delete</button>
                <a href="/print_spk/' . $data->id_schedule . '" class="btn btn-info">SPK</a>';
                if ($data->status == "Onprogress")
                    return
                        '<select id="hak_akses" class="btn btn-warning">
                        <option selected value="' . $data->id_schedule . '-Onprogress">Onprogress</option>
                        <option value="' . $data->id_schedule . '-Waiting">Waiting</option>
                        <option value="' . $data->id_schedule . '-Closed">Closed</option>
                        </select>
                <button id="delete" data-id="' . $data->id_schedule . '" class="btn btn-danger">Delete</button>
                <a href="/print_spk/' . $data->id_schedule . '" class="btn btn-info">SPK</a>';
                if ($data->status == "Waiting")
                    return
                        '<select id="hak_akses" class="btn btn-warning">
                        <option value="' . $data->id_schedule . '-Onprogress">Onprogress</option>
                        <option selected value="' . $data->id_schedule . '-Waiting">Waiting</option>
                        <option value="' . $data->id_schedule . '-Closed">Closed</option>
                        </select>
                <button id="delete" data-id="' . $data->id_schedule . '" class="btn btn-danger">Delete</button>
                <a href="/print_spk/' . $data->id_schedule . '" class="btn btn-info">SPK</a>';
                return
                    '<select id="hak_akses" class="btn btn-warning">
                    <option selected value="' . $data->id_schedule . '-Closed">Closed</option>
                    </select>
                <button id="delete" data-id="' . $data->id_schedule . '" class="btn btn-danger">Delete</button>
                <a href="/print_spk/' . $data->id_schedule . '" class="btn btn-info">SPK</a>';
            })
            ->addColumn('aksi_petugas', function ($data) {
                if ($data->status == "Open")
                    return
                        '<select id="hak_akses" style="width:80px" class="btn btn-warning">
                        <option selected value="' . $data->id_schedule . '-Open">Open</option>
                        <option value="' . $data->id_schedule . '-Onprogress">Onprogress</option>
                        <option value="' . $data->id_schedule . '-Waiting">Waiting</option>
                        <option value="' . $data->id_schedule . '-Closed">Closed</option>
                        </select>
                <a href="/print_spk/' . $data->id_schedule . '" class="btn btn-info">SPK</a>';
                if ($data->status == "Onprogress")
                    return
                        '<select id="hak_akses" class="btn btn-warning">
                        <option selected value="' . $data->id_schedule . '-Onprogress">Onprogress</option>
                        <option value="' . $data->id_schedule . '-Waiting">Waiting</option>
                        <option value="' . $data->id_schedule . '-Closed">Closed</option>
                        </select>
                <a href="/print_spk/' . $data->id_schedule . '" class="btn btn-info">SPK</a>';
                if ($data->status == "Waiting")
                    return
                        '<select id="hak_akses" class="btn btn-warning">
                        <option value="' . $data->id_schedule . '-Onprogress">Onprogress</option>
                        <option selected value="' . $data->id_schedule . '-Waiting">Waiting</option>
                        <option value="' . $data->id_schedule . '-Closed">Closed</option>
                        </select>
                <button id="delete" data-id="' . $data->id_schedule . '" class="btn btn-danger">Delete</button>
                <a href="/print_spk/' . $data->id_schedule . '" class="btn btn-info">SPK</a>';
                return
                    '<select id="hak_akses" class="btn btn-warning">
                    <option selected value="' . $data->id_schedule . '-Closed">Closed</option>
                    </select>
                <a href="/print_spk/' . $data->id_schedule . '" class="btn btn-info">SPK</a>';
            })
            ->addColumn('id_jadwal1', function ($data) {
                return
                    "SC" . date("y", strtotime($data->created_at)) . date("m", strtotime($data->created_at)) . sprintf('%04d', $data->id_jadwal);
            })
            ->rawColumns(['aksi', "id_jadwal1", 'aksi_petugas'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $record = DB::table('schedule')
            ->latest('id_schedule')
            ->first();
        if ($record === null) {
            $id_jadwal = 1;
        } else {
            if (date("Y-m", strtotime($record->created_at)) != date("Y-m")) {
                $id_jadwal = 1;
            } else {
                $id_jadwal = $record->id_jadwal + 1;
            }
        }

        $post = new m_schedule();
        $post->id_jadwal = $id_jadwal;
        $post->requester = $request->requester;
        $post->tanggal = date('Y-m-d', strtotime($request->datepicker1));
        $post->id_divisi = $request->id_divisi;
        $post->id_mesin = $request->id_mesin;
        $post->p_check = implode(",", $request->p_check);
        $post->tanggal_jadwal = date('Y-m-d', strtotime($request->datepicker2));
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
    public function pcheck(Request $request)
    {
        $mesin = DB::table('mesin')
            ->where('id_mesin', $request->id_mesin)
            ->first();
        $data = DB::table('point_check')
            ->where('jenis_mesin', $mesin->jenis_mesin)
            ->get();

        return response()->json($data);
    }

    public function update(Request $request)
    {

        $post = m_schedule::findOrFail($request->id);
        $post->keterangan = $request->keterangan;
        $post->status = $request->stat_update;
        $post->save();

        $data = [$post];
        return response()->json($data);
    }
    public function destroy($id)
    {
        $post = m_schedule::findOrFail($id);
        $post->delete = "true";
        $post->save();

        return response()->json();
    }

    public function spk($id)
    {
        $data = DB::table('schedule')
            ->join('divisi', 'schedule.id_divisi', '=', 'divisi.id_divisi')
            ->join('mesin', 'schedule.id_mesin', '=', 'mesin.id_mesin')
            ->select('schedule.*', 'divisi.nama_divisi', 'mesin.kode_mesin', 'mesin.mesin', 'mesin.jenis_mesin')
            ->where('id_schedule', $id)
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
