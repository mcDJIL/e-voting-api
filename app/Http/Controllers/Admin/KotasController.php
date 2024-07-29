<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kotas;
use Illuminate\Http\Request;

class KotasController extends Controller
{

    protected $kotaModel;
    public function __construct(Kotas $kotas)
    {
        $this->kotaModel = $kotas;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $index = $this->kotaModel->with([ 'provinsi' ])->get();

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
        $store = collect($request->only($this->kotaModel->getFillable()))->toArray();

        $new = $this->kotaModel->create($store);

        return response()->json([ 'message' => 'Data kota berhasil dibuat' ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $show = $this->kotaModel->with([ 'provinsi' ])->findOrFail($id);

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
        $kota = $this->kotaModel->findOrFail($id);

        $update = collect($request->only($this->kotaModel->getFillable()))->toArray();

        $kota->update($update);

        return response()->json([ 'message' => "Data kota berhasil diperbarui" ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->kotaModel->findOrFail($id)->delete();

        return response()->json([ 'message' => "Data kota berhasil dihapus" ]);
    }
}
