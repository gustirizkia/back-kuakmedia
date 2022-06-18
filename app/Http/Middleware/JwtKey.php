<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JwtKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('Jwt-Key') != ENV('JWT_SECRET')) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Jwt-Key not found'
            ], 401);
        }
        return $next($request);

    }
}
