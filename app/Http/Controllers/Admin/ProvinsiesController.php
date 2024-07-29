<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provinsies;
use Illuminate\Http\Request;

class ProvinsiesController extends Controller
{

    protected $provinsiModel;
    public function __construct(Provinsies $provinsies)
    {
        $this->provinsiModel = $provinsies;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $index = $this->provinsiModel->all();

        return response()->json([ 'data' => $index ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $store = collect($request->only($this->provinsiModel->getFillable()))->toArray();

        $new = $this->provinsiModel->create($store);

        return response()->json([ 'message' => 'Data provinsi berhasil dibuat'  ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $show = $this->provinsiModel->findOrFail($id);

        return response()->json([ 'data' => $show ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $provinsi = $this->provinsiModel->findOrFail($id);

        $update = collect($request->only($this->provinsiModel->getFillable()))->toArray();

        $provinsi->update($update);

        return response()->json([ 'message' => 'Data provinsi berhasil diperbarui' ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = $this->provinsiModel->findOrFail($id)->delete();

        return response()->json([ 'message' => 'Data provinsi berhasil dihapus' ]);
    }
}
