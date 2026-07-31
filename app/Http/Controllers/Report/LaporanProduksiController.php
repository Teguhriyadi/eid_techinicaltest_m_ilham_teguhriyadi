<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\ProduksiLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                function ($q) use ($request) {

                    $q->whereDate(
                        'tanggal_produksi',
                        $request->tanggal
                    );
                }
            )
            ->latest()
            ->get();


        $rekapShift = ProduksiLog::select(
            'shift',
            DB::raw(
                'SUM(jumlah_produksi) as total_produksi'
            )
        )
            ->when(
                $request->tanggal,
                function ($q) use ($request) {

                    $q->whereDate(
                        'tanggal_produksi',
                        $request->tanggal
                    );
                }
            )
            ->groupBy('shift')
            ->get();

        return response()->json([
            'data' => $produksi,
            'rekap_shift' => $rekapShift

        ]);
    }
}
