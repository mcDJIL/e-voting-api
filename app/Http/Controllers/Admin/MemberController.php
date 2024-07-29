<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Members;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    protected $membersModel;
    public function __construct(Members $members)
    {
        $this->membersModel = $members;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $index = $this->membersModel->get();

        return response()->json([ "data" => $index ]);
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
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $show = $this->membersModel->findOrFail($id);

        return response()->json([ 'data' => $show ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function banMember(Request $request, $id)
    {
        $member = $this->membersModel->findOrFail($id);

        if ($member->isBan == 0)
        {
            $member->update([ 'isBan' => 1 ]);
            return response()->json([ 'message' => 'Member berhasil diban' ]);
        } 
        else
        {
            $member->update([ 'isBan' => 0 ]);
            return response()->json([ 'message' => 'Member berhasil diunban' ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $member = $this->membersModel->findOrFail($id);

        $birthDate = Carbon::parse($request->input('tanggal_lahir'));

        $age = $birthDate->age;

        $update = collect($request->only($this->membersModel->getFillable()))
        ->put('umur', $age)
        ->toArray();

        $member->update($update);

        return response()->json([ 'message' => 'Member berhasil di update' ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = $this->membersModel->findOrFail($id)->delete();

        return response()->json([ 'message' => 'Data member berhasil dihapus' ]);
    }
}
