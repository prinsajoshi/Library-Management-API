<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminOrLibrarian
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the token is valid
        $role = Admin::where('token', $request->header('Authorization'))->first();

        // Ensure the user has the correct role
        if (!$role || !in_array($role->role, ['admin', 'librarian'])) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
