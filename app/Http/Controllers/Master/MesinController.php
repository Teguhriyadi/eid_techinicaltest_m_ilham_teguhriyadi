<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mesin\CreateRequest;
use App\Http\Requests\Mesin\UpdateRequest;
use App\Models\Mesin;
use App\Services\MesinService;
use Illuminate\Http\Request;

class MesinController extends Controller
{
    protected $mesinService;

    public function __construct(MesinService $mesinService) {
        $this->mesinService = $mesinService;
    }

    public function index()
    {
        return view("pages.modules.mesin.index");
    }
    
    public function create()
    {
        $status = Mesin::STATUS;

        return view("pages.modules.mesin.create", compact("status"));
    }

    public function datatable()
    {
        return $this->mesinService->datatable();
    }

    public function store(CreateRequest $request)
    {
        try {

            $this->mesinService->store($request->validated());

            return redirect()
                ->route('mesin.index')
                ->with('success', 'Data mesin berhasil ditambahkan.');

        } catch (\Throwable $th) {

            return back()
                ->withInput()
                ->with('error', $th->getMessage());
        }
    }

    public function edit(string $id)
    {
        $mesin = $this->mesinService->find($id);

        $status = Mesin::STATUS;

        return view('pages.modules.mesin.edit', compact(
            'mesin',
            'status'
        ));
    }

    public function update(UpdateRequest $request, string $id)
    {
        try {

            $this->mesinService->update($id, $request->validated());

            return redirect()
                ->route('mesin.index')
                ->with('success', 'Data mesin berhasil diperbarui.');

        } catch (\Throwable $th) {

            return back()
                ->withInput()
                ->with('error', $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {

            $this->mesinService->destroy($id);

            return redirect()
                ->route('mesin.index')
                ->with('success', 'Data mesin berhasil dihapus.');

        } catch (\Throwable $th) {

            return back()
                ->with('error', $th->getMessage());
        }
    }
}
