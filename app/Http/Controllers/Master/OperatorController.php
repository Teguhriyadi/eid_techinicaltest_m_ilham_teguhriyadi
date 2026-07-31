<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Operator\CreateRequest;
use App\Http\Requests\Operator\UpdateRequest;
use App\Services\OperatorService;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    protected $operatorService;

    public function __construct(OperatorService $operatorService) {
        $this->operatorService = $operatorService;
    }

    public function index()
    {
        return view("pages.modules.operator.index");
    }
    
    public function create()
    {
        return view("pages.modules.operator.create");
    }

    public function datatable()
    {
        return $this->operatorService->datatable();
    }

    public function store(CreateRequest $request)
    {
        try {

            $this->operatorService->store($request->validated());

            return redirect()
                ->route('operator.index')
                ->with('success', 'Data operator berhasil ditambahkan.');

        } catch (\Throwable $th) {

            return back()
                ->withInput()
                ->with('error', $th->getMessage());
        }
    }

    public function edit(string $id)
    {
        $operator = $this->operatorService->find($id);

        return view('pages.modules.operator.edit', compact(
            'operator',
        ));
    }

    public function update(UpdateRequest $request, string $id)
    {
        try {

            $this->operatorService->update($id, $request->validated());

            return redirect()
                ->route('operator.index')
                ->with('success', 'Data operator berhasil diperbarui.');

        } catch (\Throwable $th) {

            return back()
                ->withInput()
                ->with('error', $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {

            $this->operatorService->destroy($id);

            return redirect()
                ->route('operator.index')
                ->with('success', 'Data operator berhasil dihapus.');

        } catch (\Throwable $th) {

            return back()
                ->with('error', $th->getMessage());
        }
    }

    public function toggleStatus(string $id)
    {
        try {

            $this->operatorService->toggleStatus($id);

            return response()->json([
                'success' => true,
                'message' => 'Status operator berhasil diperbarui.'
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);

        }
    }
}
