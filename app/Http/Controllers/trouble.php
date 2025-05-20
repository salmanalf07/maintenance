<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\m_trouble;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
        // $data = DB::table('trouble')
        //     ->join('divisi', 'trouble.id_divisi', '=', 'divisi.id_divisi')
        //     ->join('mesin', 'trouble.id_mesin', '=', 'mesin.id_mesin')
        //     ->select('trouble.*', 'divisi.nama_divisi', 'mesin.id_mesin', 'mesin.mesin');
        $data = m_trouble::with('divisi', 'mesin', 'detailTrouble')
            ->when($request->session()->get("hak_akses") == "Petugas", function ($query) {
                // Hanya tampilkan data untuk role Petugas
                $query->whereDoesntHave('detailTrouble') // Tidak ada relasi detailTrouble
                    ->orWhereHas('detailTrouble', function ($query) {
                        $query->where('mtcId', Auth::user()->id); // Atau jika ada, relasi detailTrouble sesuai dengan mtcId
                    });
            });

        if ($request->session()->get("hak_akses") == "User") {
            $data->where([
                // ['trouble.delete', '!=', "true"],
                ['requester', '=', $request->session()->get("name")],
            ]);
        }
        $data->get();


        return Datatables::of($data)
            ->addColumn('images', function ($data) {
                if ($data->image != null) {
                    return
                        '<button id="view-image" onclick="getImage(\'lkm\',\'' . $data->image . '\')" data-id="' . $data->image . '" class="btn btn-primary">Gambar</button>';
                }
            })
            ->addColumn('aksi', function ($data) {
                if ($data->status == "Open")
                    return
                        '<select id="hak_akses" style="width:80px" class="btn btn-danger">
                        <option selected value="' . $data->id . '-Open">Open</option>
                        <option value="' . $data->id . '-Onprogress">Onprogress</option>
                        <option value="' . $data->id . '-Waiting">Waiting</option>
                        <option value="' . $data->id . '-Closed">Closed</option>
                        </select>
                        <button id="detail" data-id="' . $data->id . '" class="btn btn-secondary" title="Detail"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button id="delete" data-id="' . $data->id . '" class="btn btn-danger" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                if ($data->status == "Onprogress")
                    return
                        '<select id="hak_akses" class="btn btn-warning">
                        <option value="' . $data->id . '-Open">Open</option>
                        <option selected value="' . $data->id . '-Onprogress">Onprogress</option>
                        <option value="' . $data->id . '-Waiting">Waiting</option>
                        <option value="' . $data->id . '-Closed">Closed</option>
                        </select>
                        <button id="detail" data-id="' . $data->id . '" class="btn btn-secondary" title="Detail"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button id="delete" data-id="' . $data->id . '" class="btn btn-danger" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                if ($data->status == "Waiting")
                    return
                        '<select id="hak_akses" class="btn btn-secondary">
                        <option value="' . $data->id . '-Open">Open</option>
                        <option value="' . $data->id . '-Onprogress">Onprogress</option>
                        <option selected value="' . $data->id . '-Waiting">Waiting</option>
                        <option value="' . $data->id . '-Closed">Closed</option>
                        </select>
                        <button id="detail" data-id="' . $data->id . '" class="btn btn-secondary" title="Detail"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button id="delete" data-id="' . $data->id . '" class="btn btn-danger" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                return
                    '<select id="hak_akses" class="btn btn-succes">
                    <option value="' . $data->id . '-Open">Open</option>
                    <option value="' . $data->id . '-Onprogress">Onprogress</option>
                    <option value="' . $data->id . '-Waiting">Waiting</option>
                    <option selected value="' . $data->id . '-Closed">Closed</option>
                    </select>
                    <button id="detail" data-id="' . $data->id . '" class="btn btn-secondary" title="Detail"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <button id="delete" data-id="' . $data->id . '" class="btn btn-danger" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>';
            })
            ->addColumn('aksi_petugas', function ($data) {
                if ($data->status == "Open")
                    return
                        '<select id="hak_akses" style="width:80px" class="btn btn-danger">
                        <option selected value="' . $data->id . '-Open">Open</option>
                        <option value="' . $data->id . '-Onprogress">Onprogress</option>
                        <option value="' . $data->id . '-Waiting">Waiting</option>
                        <option value="' . $data->id . '-Closed">Closed</option>
                        </select>
                        <button id="detail" data-id="' . $data->id . '" class="btn btn-secondary" title="Detail"><i class="fa fa-search" aria-hidden="true"></i></button>';
                if ($data->status == "Onprogress")
                    return
                        '<select id="hak_akses" class="btn btn-warning">
                        <option selected value="' . $data->id . '-Onprogress">Onprogress</option>
                        <option value="' . $data->id . '-Waiting">Waiting</option>
                        <option value="' . $data->id . '-Closed">Closed</option>
                        </select>
                        <button id="detail" data-id="' . $data->id . '" class="btn btn-secondary" title="Detail"><i class="fa fa-search" aria-hidden="true"></i></button>';
                if ($data->status == "Waiting")
                    return
                        '<select id="hak_akses" class="btn btn-secondary">
                        <option value="' . $data->id . '-Open">Open</option>
                        <option value="' . $data->id . '-Onprogress">Onprogress</option>
                        <option selected value="' . $data->id . '-Waiting">Waiting</option>
                        <option value="' . $data->id . '-Closed">Closed</option>
                        </select>
                        <button id="detail" data-id="' . $data->id . '" class="btn btn-secondary" title="Detail"><i class="fa fa-search" aria-hidden="true"></i></button>';
                return
                    '<select id="hak_akses" class="btn btn-succes">
                    <option selected value="' . $data->id . '-Closed">Closed</option>
                    </select
                    <button id="detail" data-id="' . $data->id . '" class="btn btn-secondary" title="Detail"><i class="fa fa-search" aria-hidden="true"></i></button>';
            })
            ->addColumn('id_trouble', function ($data) {
                return
                    getIdTrouble($data->created_at, $data->id_trouble);
            })
            ->rawColumns(['aksi', "id_trouble", 'aksi_petugas', 'images'])
            ->toJson();
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'divisi' => ['required', 'not_equal_to:#'],
                'mesin' => ['required', 'not_equal_to:#'],
                'dateTrouble' => ['required'],
                'judul' => ['required'],
                'image' => 'required|image|max:1024', // max 1MB
                'uraianMasalah' => ['required'],

            ]);
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
            $image = $request->file('image');
            $imageName = $id_trouble . '-' . substr(uniqid(), -5) . '.' . $image->getClientOriginalExtension();

            $post = new m_trouble();
            $post->id_trouble = $id_trouble;
            $post->requester = $request->requester;
            $post->tgl_perbaikan = date('Y-m-d', strtotime($request->dateTrouble));
            $post->id_divisi = $request->divisi;
            $post->id_mesin = $request->mesin;
            $post->judul = $request->judul;
            $post->image = $imageName;
            $post->keterangan = $request->uraianMasalah;
            $post->status = "Open";
            $post->save();

            $image->move(public_path('assets/uploads/lkm'), $imageName); // Simpan di public/assets


            $data = [$post];
            return response()->json($data);
        } catch (ValidationException $error) {
            return response()->json([
                'errors' => $error->errors()
            ], 422);
        }
    }

    public function detail(Request $request)
    {
        $data = m_trouble::findOrFail($request->id);
        $data->id_trouble = getIdTrouble($data->created_at, $data->id_trouble);
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

        // Jika status diubah menjadi 'Open', hapus relasi detailTrouble jika ada
        if ($request->status === 'Open') {
            $post->detailTrouble()->delete();
        } else {
            // Update atau buat record baru untuk detailTrouble jika status bukan 'Open'
            $post->detailTrouble()->updateOrCreate(
                [], // Jika tidak ada kondisi pencarian, berarti akan selalu mencoba untuk membuat baru
                [
                    'troubleId' => $post->id,
                    'mtcId' => Auth::user()->id,
                    'mulaiPerbaikan' => now(),  // Gunakan fungsi now() untuk waktu sekarang
                ]
            );
        }

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
