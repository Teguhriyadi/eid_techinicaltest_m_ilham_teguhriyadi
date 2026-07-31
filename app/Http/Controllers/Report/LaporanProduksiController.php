<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\ProduksiLog;
use Illuminate\Http\Request;

class LaporanProduksiController extends Controller
{
    public function index()
    {
        return view(
            'pages.modules.laporan.index'
        );
    }


    public function data(Request $request)
    {

        $produksi = ProduksiLog::with([
            'mesin',
            'operator'
        ])
        ->when(
            $request->tanggal,
            function($q) use($request){

                $q->whereDate(
                    'tanggal_produksi',
                    $request->tanggal
                );

            }
        )
        ->latest()
        ->get();


        return response()->json([
            'data'=>$produksi
        ]);
    }
}
