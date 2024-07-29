<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CapresCawapres;
use App\Models\PemiluPresiden;
use Illuminate\Http\Request;

class PemiluPresidenController extends Controller
{

    protected $capresModel;
    public function __construct(CapresCawapres $capresCawapres)
    {
        $this->capresModel = $capresCawapres;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $index = $this->capresModel->where('status_pemilu', 1)->get();

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
        $store = collect($request->only($this->capresModel->getFillable()))->toArray();

        $new = $this->capresModel->create($store);

        return response()->json([ 'message' => 'Data Pemilu berhasil dibuat' ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request)
    {
        $pemilu = CapresCawapres::where('status_pemilu', 1)->get();

        foreach ($pemilu as $item) {
            $item->update([ 'status_pemilu' => 0 ]);
        }

        return response()->json([ 'message' => 'Pemilu telah berakhir' ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
