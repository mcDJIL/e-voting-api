<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admins;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $admin = Admins::where('username', $request->username)->where('password', $request->password)->first();

        if (!$admin) return response()->json([ 'message' => 'Username or Password is wrong' ], 401);

        $token = md5($request->id);

        $admin->update(['token' => $token]);

        return response()->json([ 'data' => $admin ]);
    }

    public function logout(Request $request)
    {
        $token = $request->query('token');

        $admin = Admins::where('token', $token)->first();

        if (!$admin || $token === null) return response()->json([ 'message' => 'Unauthorized User' ], 401);

        $admin->update([ 'token' => null ]);

        return response()->json([ 'message' => 'Logout Success' ]);
    }
}
