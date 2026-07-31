<?php

namespace App\Services;

use App\Models\Mesin;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MesinService
{
    public function datatable()
    {
        return DataTables::of(Mesin::orderBy("created_at", "DESC"))
            ->addIndexColumn()

            ->editColumn('temperatur', function ($row) {
                return $row->temperatur . ' °C';
            })

            ->addColumn('action', function ($row) {
                return view('pages.modules.mesin.action', compact('row'));
            })

            ->rawColumns(['action'])

            ->make(true);
    }

    public function find(string $id): Mesin
    {
        return Mesin::findOrFail($id);
    }

    public function store(array $data): void
    {
        DB::beginTransaction();

        try {

            Mesin::create($data);

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;
        }
    }

    public function update(string $id, array $data): void
    {
        DB::beginTransaction();

        try {

            $mesin = Mesin::findOrFail($id);

            $mesin->update($data);

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

            $mesin = Mesin::findOrFail($id);

            $mesin->delete();

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;
        }
    }
}