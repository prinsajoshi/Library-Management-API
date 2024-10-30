<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminController extends Controller
{
     // Admin login
     public function login(Request $request)
     {
         $request->validate([
             'username' => 'required|string',
             'password' => 'required|string',
         ]);
 
         $admin = Admin::where('username', $request->username)->first();
 
         if ($admin && Hash::check($request->password, $admin->password)) {
             $admin->token = Str::random(32);  // Generate a new token
             $admin->save();
 
             return response()->json([
                 'message' => 'Login successful',
                 'token' => $admin->token,
             ], 200);
         }
 
         return response()->json(['error' => 'Invalid credentials'], 401);
     }
 
     // Create Librarian
     public function createLibrarian(Request $request)
     {
         $request->validate([
             'username' => 'required|string|unique:admins,username',
             'password' => 'required|string',
             'email' => 'required|string|email|unique:admins,email',
         ]);

          // Check if the token is valid and if the role is either admin or librarian
        $admin = Admin::where('token', $request->header('Authorization'))->first();

        if (!$admin || !Admin::where('role', 'admin')->exists()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
 
         $librarian = Admin::create([
             'username' => $request->username,
             'password' => Hash::make($request->password),  // Encode the password
             'role' => 'librarian',
             'token' => Str::random(32),  // Generate a token for the librarian
             'email' => $request->email,
         ]);

         $librarian->makeHidden(['password', 'created_at', 'updated_at']);
 
         return response()->json([
             'message' => 'Librarian created successfully',
             'librarian' => $librarian,
         ], 201);
     }

     // Create User
    public function createUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:admins,username',
            'password' => 'required|string',
            'email' => 'required|string|email|unique:admins,email',
        ]);

        // Check if the token is valid and if the role is either admin or librarian
        $admin = Admin::where('token', $request->header('Authorization'))->first();

        if (!$admin || !in_array($admin->role, ['admin', 'librarian'])) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Create the new user
        $newUser = Admin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash the password
            'role' => 'User', // Set the role from request
            'token' => Str::random(32), // Generate a new token for the user
            'email' => $request->email,
        ]);

        // Hide sensitive attributes
        $newUser->makeHidden(['password', 'created_at', 'updated_at']);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $newUser,
        ], 201);
    }


    public function removeLibrarian(Request $request)
    {
     
        // Validate that the librarian_id is provided in the request
        $request->validate([
            'librarian_id' => 'required',
        ]);

        // Find the librarian by ID
        $librarian = Admin::find($request->librarian_id);

        // Ensure the user being removed has the role of "librarian"
        if ($librarian->role !== 'librarian') {
            return response()->json(['error' => 'The specified user is not a librarian'], 400);
        }

        // Delete the librarian
        $librarian->delete();

        return response()->json(['message' => 'Librarian removed successfully'], 200);
    }

     
}
