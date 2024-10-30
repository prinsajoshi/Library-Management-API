<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    // Check if the token is valid and if the user has the 'admin' role
    $admin = Admin::where('token', $request->header('Authorization'))->first();

    // Allow access only if the role is 'admin'
    if (!$admin || $admin->role !== 'admin') {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    return $next($request);
    }

   
}
