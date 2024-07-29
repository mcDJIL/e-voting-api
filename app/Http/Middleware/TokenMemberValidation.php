<?php

namespace App\Http\Middleware;

use App\Models\Members;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenMemberValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->query('token');

        $member = Members::where('token', $token)->first();

        if (!$member || $token === null) return response()->json([ 'message' => 'Unauthorized User' ], 401);

        return $next($request);
    }
}
