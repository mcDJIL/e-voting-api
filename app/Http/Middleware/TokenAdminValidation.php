<?php

namespace App\Http\Middleware;

use App\Models\Admins;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenAdminValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->query('token');

        $admin = Admins::where('token', $token)->first();

        if (!$admin || $token === null) return response()->json([ 'message' => 'Unauthorized User' ], 401);

        return $next($request);
    }
}
