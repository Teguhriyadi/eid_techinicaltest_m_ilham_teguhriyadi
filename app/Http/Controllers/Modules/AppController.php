<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Models\Mesin;
use App\Models\Operator;
use App\Models\ProduksiLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function dashboard()
    {
        return view("pages.modules.dashboard");
    }

    public function statistik()
    {
        $today = Carbon::today();

        $monitoring = ProduksiLog::with(['mesin', 'operator'])
            ->latest('tanggal_produksi')
            ->get()
            ->map(function ($item) {
                return [
                    'kode_mesin' => $item->mesin->kode_mesin,
                    'nama_mesin' => $item->mesin->nama_mesin,
                    'status' => $item->status,
                    'temperatur' => $item->temperatur,
                    'operator' => $item->operator->nama,
                    'shift' => $item->shift,
                    'jumlah_produksi' => $item->jumlah_produksi,
                ];
            });

        return response()->json([

            'total_mesin' => Mesin::count(),

            'running' => Mesin::where('status', Mesin::STATUS_RUNNING)->count(),

            'idle' => Mesin::where('status', Mesin::STATUS_IDLE)->count(),

            'maintenance' => Mesin::where('status', Mesin::STATUS_MAINTENANCE)->count(),

            'error' => Mesin::where('status', Mesin::STATUS_ERROR)->count(),

            'operator_aktif' => Operator::where('is_active', true)->count(),

            'total_produksi' => ProduksiLog::whereDate('tanggal_produksi', $today)
                ->sum('jumlah_produksi'),

            'chart' => [
                'labels' => ProduksiLog::whereDate('tanggal_produksi', $today)
                    ->selectRaw('HOUR(tanggal_produksi) as jam')
                    ->groupBy('jam')
                    ->orderBy('jam')
                    ->pluck('jam')
                    ->values(),

                'data' => ProduksiLog::whereDate('tanggal_produksi', $today)
                    ->selectRaw('SUM(jumlah_produksi) as total')
                    ->groupBy(DB::raw('HOUR(tanggal_produksi)'))
                    ->orderBy(DB::raw('HOUR(tanggal_produksi)'))
                    ->pluck('total')
                    ->values(),
            ],
            'monitoring' => $monitoring
        ]);
    }
}
