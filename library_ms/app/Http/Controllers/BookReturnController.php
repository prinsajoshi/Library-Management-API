<?php

namespace App\Http\Controllers;

use App\Models\Book_User;
use Illuminate\Http\Request;

class BookReturnController extends Controller
{
    public function returnBook(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|exists:admins,id',
            'book_id' => 'required|exists:books,id',
        ]);

        // Find the record in book_users for the given user_id and book_id
        $bookUser = Book_User::where('user_id', $request->user_id)
            ->where('book_id', $request->book_id)
            ->first();

        // Check if the record exists
        if (!$bookUser) {
            return response()->json([
                'message' => 'No record found for this book borrowed by the user.',
            ], 404); 
        }

        // Delete the record
        $bookUser->delete();

        return response()->json([
            'message' => 'Book returned successfully.',
        ], 200); 
    }
}
