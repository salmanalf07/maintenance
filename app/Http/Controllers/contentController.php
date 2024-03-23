<?php

namespace App\Http\Controllers;

use App\Models\categoryBoard;
use App\Models\contentBoard;
use App\Models\m_mesin;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;

class contentController extends Controller
{
    function index(Request $request)
    {
        $judul = "Category Board";
        $category = categoryBoard::get();
        $machine = m_mesin::get();

        return view('/digitalBoard/master/contentBoard', [
            'judul' => $judul,
            'category' => $category,
            'machine' => $machine
        ]);
    }

    public function json()
    {
        $data = contentBoard::with('category')->get();

        return datatables()::of($data)
            ->addColumn('showKonten', function ($data) {
                return
                    '<a id="showKonten" href="#" data-konten="' . $data->directory . '">' . $data->directory . '</a>';
            })
            ->addColumn('aksi', function ($data) {
                return
                    '<button id="edit" data-id="' . $data->id . '" class="btn btn-primary">Edit</button>
                    <button id="delete" data-id="' . $data->id . '" class="btn btn-danger">Delete</button>';
            })
            ->rawColumns(['aksi', 'showKonten'])
            ->toJson();
    }

    function store(Request $request)
    {
        try {
            $request->validate([
                'directory' => 'file|max:10240', // Max 10MB
                'categoryId' => 'required|not_in:0', // Max 10MB
                // 'status' => 'required|not_in:#', // Max 10MB
            ]);

            $file = $request->file('directory');

            $data = contentBoard::findOrNew($request->id);
            $data->categoryId = $request->categoryId;
            if ($file) {
                $nama_file = $file->getClientOriginalName();
                // Simpan file ke direktori public
                $path = $file->storeAs('content', substr(uniqid(), -5) . $nama_file, 'public');
                if ($data->directory != null) {
                    if (file_exists(public_path() . '/assets/' . $data->directory)) {
                        unlink(public_path() . '/assets/' . $data->directory);
                    }
                }
                $data->directory = 'assets/uploads/' . $path;
            }
            $data->status = $request->status == '#' ? 'Active' : $request->status;
            $data->save();

            if ($request->machine) {
                $data->contentMachine()->detach();
                // Membuat array dari UUID machines yang diterima dari form
                $machineIds = $request->input('machine');

                foreach ($machineIds as $machineId) {
                    $pivotId = Uuid::uuid4()->toString();
                    $data->contentMachine()->attach([$machineId => ['id' => $pivotId]]);
                }
            }

            return response()->json($data);
        } catch (ValidationException $error) {
            $data = [$error->errors(), "error"];
            return response($data);
        }
    }


    function edit(Request $request)
    {
        $data = contentBoard::with('machine')->findOrFail($request->id);

        return response()->json($data);
    }


    function destroy($id)
    {
        $data = contentBoard::with('machine')->findOrFail($id);
        $data->machine()->delete();
        $data->forceDelete(); // Untuk menghapus secara permanen

        if (file_exists(public_path() . '/assets/' . $data->directory)) {
            unlink(public_path() . '/assets/' . $data->directory);
        }
        return response()->json($data);
    }

    function get_contentBoard(Request $request)
    {
        $data = categoryBoard::where('name', $request->category)
            ->with(['content.machine' => function ($query) use ($request) {
                $query->where('mesinId', $request->mesinId);
            }])
            ->first();

        return response()->json($data);
    }
}
