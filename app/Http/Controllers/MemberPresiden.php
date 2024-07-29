<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\PemiluPresiden;
use Carbon\Carbon;
use Illuminate\Http\Request;

//Controller buat get data pemilih presiden, count data berdasarkan pilihan presiden.
//Melakukan pemilihan presiden dan terakhir show data yang dipilih member
class MemberPresiden extends Controller
{
    protected $presidenModel;
    public function __construct(PemiluPresiden $pemiluPresiden)
    {
        $this->presidenModel = $pemiluPresiden;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $index = $this->presidenModel->all();

        return response()->json([ 'data' => $index ]);
    }

    public function realCount(Request $request)
    {
        $pasangan1 = $this->presidenModel->where('pilihan', 1)->count();
        $pasangan2 = $this->presidenModel->where('pilihan', 2)->count();
        $pasangan3 = $this->presidenModel->where('pilihan', 3)->count();

        return response()->json([ 'pilihan_1' => $pasangan1, 'pilihan_2' => $pasangan2, 'pilihan_3' => $pasangan3 ]);
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
        $token = $request->query('token');
        $member = Members::where('token', $token)->first();

        $today = Carbon::now()->toDateString();

        $store = collect($request->only($this->presidenModel->getFillable()))
        ->put('email', $member->email)->put('provinsi_domisili', $member->provinsi_domisili)
        ->put('kota_domisili', $member->kota_domisili)->put('tanggal_pemilu', $today)
        ->toArray();

        $new = $this->presidenModel->create($store);

        return response()->json([ 'message' => 'Berhasil memilih capres dan cawapres' ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $token = $request->query('token');
        $member = Members::where('token', $token)->first();

        $show = $this->presidenModel->where('email', $member->email)->first();

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
