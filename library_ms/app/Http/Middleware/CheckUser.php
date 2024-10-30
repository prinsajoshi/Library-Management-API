<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    public function handle(Request $request, Closure $next): Response
   {
    // Get the token from the Authorization header
    $token = $request->header('Authorization');

    // Check if the token exists
    if (!$token) {
        return response()->json(['error' => 'Token is required'], 401); 
    }

    // Find the user with the given token
    $user = Admin::where('token', $token)->first();

    // Check if user exists and if the token's user_id matches the request's user_id
    if (!$user || $user->id !== (int) $request->user_id) {
        return response()->json(['error' => 'Unauthorized: You are trying to access another user\'s data'], 403); 
    }

    return $next($request);
    }
}
