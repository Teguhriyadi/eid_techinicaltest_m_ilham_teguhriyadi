<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Produksi\CreateRequest;
use App\Http\Requests\Produksi\UpdateRequest;
use App\Models\Mesin;
use App\Models\Operator;
use App\Models\ProduksiLog;
use App\Services\ProduksiService;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    protected $produksiService;

    public function __construct(ProduksiService $produksiService)
    {
        $this->produksiService = $produksiService;
    }

    public function index()
    {
        return view("pages.modules.produksi.index");
    }

    public function create()
    {
        $mesin = Mesin::orderBy('nama_mesin')->get();

        $operator = Operator::where('is_active', true)
            ->orderBy('nama')
            ->get();
            
        $shift = ProduksiLog::SHIFT;
        $status = ProduksiLog::STATUS;

        return view("pages.modules.produksi.create", compact("mesin", "operator", "shift", "status"));
    }

    public function datatable()
    {
        return $this->produksiService->datatable();
    }

    public function store(CreateRequest $request)
    {
        try {

            $this->produksiService->store($request->validated());

            return redirect()
                ->route('produksi.index')
                ->with('success', 'Data produksi berhasil ditambahkan.');
        } catch (\Throwable $th) {

            return back()
                ->withInput()
                ->with('error', $th->getMessage());
        }
    }

    public function edit(string $id)
    {
        $mesin = Mesin::orderBy('nama_mesin')->get();

        $operator = Operator::where('is_active', true)
            ->orderBy('nama')
            ->get();
            
        $shift = ProduksiLog::SHIFT;
        $status = ProduksiLog::STATUS;
        
        $produksi = $this->produksiService->find($id);

        return view('pages.modules.produksi.edit', compact(
            'mesin',
            'produksi',
            'operator',
            'shift',
            'status'
        ));
    }

    public function update(UpdateRequest $request, string $id)
    {
        try {

            $this->produksiService->update($id, $request->validated());

            return redirect()
                ->route('produksi.index')
                ->with('success', 'Data produksi berhasil diperbarui.');
        } catch (\Throwable $th) {

            return back()
                ->withInput()
                ->with('error', $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {

            $this->produksiService->destroy($id);

            return redirect()
                ->route('produksi.index')
                ->with('success', 'Data produksi berhasil dihapus.');
        } catch (\Throwable $th) {

            return back()
                ->with('error', $th->getMessage());
        }
    }
}
