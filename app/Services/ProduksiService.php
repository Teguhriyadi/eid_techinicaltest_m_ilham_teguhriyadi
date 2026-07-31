<?php

namespace App\Services;

use App\Events\ProduksiCreated;
use App\Models\Mesin;
use App\Models\ProduksiLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProduksiService
{
    public function datatable()
    {
        return DataTables::of(ProduksiLog::with(["operator", "mesin"])->orderBy("created_at", "DESC"))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('pages.modules.produksi.action', compact('row'));
            })
            ->editColumn('mesin', function ($row) {
                return '(' . $row->mesin->kode_mesin . ') ' .  $row->mesin->nama_mesin;
            })
            ->editColumn('tanggal_produksi', function ($row) {
                return Carbon::parse($row->tanggal_produksi)
                    ->translatedFormat('d F Y, H:i');
            })
            ->editColumn('operator', function ($row) {
                return $row->operator->nama;
            })
            ->rawColumns(['action', 'mesin', 'operator'])

            ->make(true);
    }

    public function find(string $id): ProduksiLog
    {
        return ProduksiLog::findOrFail($id);
    }

    public function store(array $data): void
    {
        DB::beginTransaction();

        try {

            $produksi = ProduksiLog::create($data);

            $mesin = Mesin::findOrFail($data['mesin_id']);

            $mesin->update([
                'status' => $data['status'],
                'temperatur' => $data['temperatur'],
            ]);

            DB::commit();

            event(new ProduksiCreated($produksi));
        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;
        }
    }

    public function update(string $id, array $data): void
    {
        DB::beginTransaction();

        try {

            $produksiLog = ProduksiLog::findOrFail($id);

            $produksiLog->update($data);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;
        }
    }

    public function destroy(string $id): void
    {
        DB::beginTransaction();

        try {

            $produksiLog = ProduksiLog::findOrFail($id);

            $produksiLog->delete();

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;
        }
    }
}
