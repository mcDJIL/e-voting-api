<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    
    protected $memberModel;
    public function __construct(Members $members)
    {
        $this->memberModel = $members;
    }

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'unique:members'
        ], [
            'email.unique' => 'Email telah digunakan'
        ]);

        if ($validation->fails()) return response()->json(['message' => $validation->errors()], 422);

        $register = collect($request->only($this->memberModel->getFillable()))
        ->put('token', md5($request->email))
        ->toArray();

        $new = $this->memberModel->create($register);

        return response()->json([ 'data' => $register ]);
    }

    public function login(Request $request)
    {
        $member = Members::where('email', $request->email)->where('password', $request->password)->first();

        if (!$member) return response()->json([ 'message' => 'Email or Password is wrong' ], 401);
 
        $token = md5($request->email);

        $member->update(['token' => $token]);

        return response()->json([ 'data' => $member ]);
    }

    public function logout(Request $request)
    {
        $token = $request->query('token');

        $member = Members::where('token', $token)->first();

        if (!$member || $token === null) return response()->json([ 'message' => 'Unauthorized User' ], 401);

        $member->update([ 'token' => null ]);

        return response()->json([ 'message' => 'Logout Success' ]);
    }

    public function updateProfile(Request $request)
    {
        $token = $request->query('token');

        $member = Members::where('token', $token)->first();

        $birthDate = Carbon::parse($request->input('tanggal_lahir'));

        $age = $birthDate->age;

        $update = collect($request->only($this->memberModel->getFillable()))
        ->put('umur', $age)
        ->toArray();

        $member->update($update);

        return response()->json([ 'message' => 'Profil berhasil diperbarui', 'data' => $member ]);
    }

    public function me(Request $request)
    {
        $token = $request->query('token');

        $me = Members::where('token', $token)->first();

        return response()->json([ 'data' => $me ]);
    }
}
