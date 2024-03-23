<?php

namespace App\Http\Controllers;

use App\Models\m_mesin;
use Illuminate\Http\Request;

class digitalBoardController extends Controller
{
    function index(Request $request)
    {
        $mesin = m_mesin::with('jenisMesin')->where('kode_mesin', $request->mesin)->first();

        return view('/digitalBoard/v_digitalBoard', [
            'mesin' => $mesin
        ]);
    }
}
