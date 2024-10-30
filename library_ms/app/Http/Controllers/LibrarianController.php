<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class LibrarianController extends Controller
{
    // Create a new book
    public function createBook(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn',
            'description' => 'nullable|string',
        ]);

        $book = Book::create($request->all());

        return response()->json([
            'message' => 'Book created successfully',
            'book' => $book,
        ], 201);
    }

    // Read all books
    public function getBooks()
    {
        $books = Book::all();
        return response()->json($books, 200);
    }

    // Read a single book
    public function getBook($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        return response()->json($book, 200);
    }

    // Update a book
    public function updateBook(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'isbn' => 'sometimes|required|string|unique:books,isbn,' . $id,
            'description' => 'nullable|string',
        ]);

        $book = Book::find($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        $book->update($request->all());
        return response()->json([
            'message' => 'Book updated successfully',
            'book' => $book,
        ], 200);
    }

    // Delete a book
    public function deleteBook($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        $book->delete();
        return response()->json(['message' => 'Book deleted successfully'], 200);
    }

}
