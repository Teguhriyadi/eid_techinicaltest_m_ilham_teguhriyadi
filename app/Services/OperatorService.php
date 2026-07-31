<?php

namespace App\Services;

use App\Models\Mesin;
use App\Models\Operator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OperatorService
{
    public function datatable()
    {
        return DataTables::of(Operator::orderBy("created_at", "DESC"))
            ->addIndexColumn()
            ->editColumn('status', function ($row) {

                $checked = $row->is_active ? 'checked' : '';
                $label = $row->is_active ? 'Aktif' : 'Tidak Aktif';

                return '
                    <div class="d-flex align-items-center">
                        <div class="custom-control custom-switch mb-0">
                            <input
                                type="checkbox"
                                class="custom-control-input toggle-status"
                                id="switch-' . $row->id . '"
                                data-id="' . $row->id . '"
                                ' . $checked . '>

                            <label class="custom-control-label" for="switch-' . $row->id . '"></label>
                        </div>

                        <span class="ml-2 ' . ($row->is_active ? 'text-success' : 'text-danger') . ' font-weight-bold">
                            ' . $label . '
                        </span>
                    </div>
                ';
            })
            ->addColumn('action', function ($row) {
                return view('pages.modules.operator.action', compact('row'));
            })

            ->rawColumns(['action', 'status'])

            ->make(true);
    }

    public function find(string $id): Operator
    {
        return Operator::findOrFail($id);
    }

    public function store(array $data): void
    {
        DB::beginTransaction();

        try {

            Operator::create($data);

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

            $operator = Operator::findOrFail($id);

            $operator->update($data);

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

            $operator = Operator::findOrFail($id);

            $operator->delete();

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;
        }
    }

    public function toggleStatus(string $id): void
    {
        DB::beginTransaction();

        try {

            $operator = Operator::findOrFail($id);

            $operator->update([
                'is_active' => !$operator->is_active,
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;
        }
    }
}
