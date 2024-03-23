<?php

namespace App\Http\Controllers;

use App\Models\categoryBoard;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class categoryBoardController extends Controller
{
    function index(Request $request)
    {
        $judul = "Category Board";

        return view('/digitalBoard/master/categoryBoard', [
            'judul' => $judul,
        ]);
    }

    public function json()
    {
        $data = categoryBoard::get();

        return datatables()::of($data)
            ->addColumn('aksi', function ($data) {
                return
                    '<button id="edit" data-id="' . $data->id . '" class="btn btn-primary">Edit</button>
                    <button id="delete" data-id="' . $data->id . '" class="btn btn-danger">Delete</button>';
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    function store(Request $request)
    {
        try {
            $data = categoryBoard::findOrNew($request->id);
            $data->name = $request->name;
            $data->keterangan = $request->keterangan;
            $data->save();

            return response()->json($data);
        } catch (ValidationException $error) {
            $data = [$error->errors(), "error"];
            return response($data);
        }
    }


    function edit(Request $request)
    {
        $data = categoryBoard::findOrFail($request->id);

        return response()->json($data);
    }


    function destroy($id)
    {
        $data = categoryBoard::findOrFail($id);
        $data->delete();

        return response()->json($data);
    }
}
