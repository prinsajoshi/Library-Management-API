<?php

namespace App\Http\Controllers;

use App\Models\Book_User;
use Illuminate\Http\Request;

class UserController extends Controller
{
     // Function to get borrowed books for a specific user
     public function getBorrowedBooks(Request $request)
     {
         // Validate the incoming request to ensure user_id is provided
         $request->validate([
             'user_id' => 'required|exists:admins,id',
         ]);
 
         // Retrieve the borrowed books for the user
         $borrowedBooks = Book_User::with('book') 
             ->where('user_id', $request->user_id)
             ->get();
 
         return response()->json([
             'borrowed_books' => $borrowedBooks,
         ], 200); 
     }

     


    }
