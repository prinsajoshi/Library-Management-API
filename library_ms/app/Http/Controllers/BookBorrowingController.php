<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_User;
use Illuminate\Http\Request;
use App\Models\BookUser; // Assuming you create a model for book_users
use Carbon\Carbon;

class BookBorrowingController extends Controller
{
    // Function to borrow a book
    public function borrowBook(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|exists:admins,id',
            'book_id' => 'required|exists:books,id',
            'taken_date' => 'required|date',
        ]);

         // Check if the book is already borrowed
         $existingBorrow = Book_User::where('book_id', $request->book_id)
         ->where('submission_date', '>=', now()) // Check if the submission date is in the future or today
         ->first();

        if ($existingBorrow) {
            return response()->json([
                'message' => 'Book is already taken by another user.',
            ], 409); // Conflict status code
        }


        // Calculate the submission date as 7 days after taken_date
        $takenDate = Carbon::parse($request->taken_date);
        $submissionDate = $takenDate->copy()->addDays(7);

        //Reminder date just before the submission date
        $reminderDate = $takenDate->copy()->addDays(6);

        // Insert the borrowing record
        $bookUser = Book_User::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'taken_date' => $takenDate,
            'submission_date' => $submissionDate,
            'reminder_date'=>$reminderDate
        ]);

        return response()->json([
            'message' => 'Book borrowed successfully',
            'data' => $bookUser,
        ], 201);
    }



     // Function to get all taken books
     public function getTakenBooks()
     {
         $takenBooks = Book::whereHas('bookUsers') 
             ->with('bookUsers') // Include the related book_users
             ->get();
 
         return response()->json([
             'taken_books' => $takenBooks,
         ], 200); 
     }



      // Function to get available books
    public function getAvailableBooks()
    {
        $availableBooks = Book::whereDoesntHave('bookUsers') // Check for books without related book_users
            ->get();

        return response()->json([
            'available_books' => $availableBooks,
        ], 200); 
    }
}
