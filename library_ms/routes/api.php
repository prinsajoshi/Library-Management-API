<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookBorrowingController;
use App\Http\Controllers\BookReturnController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\UserController;
use Database\Seeders\BookSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\Library;



//login and update token everytime when login
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/librarian/login', [AdminController::class, 'login']);
Route::post('/User/login', [AdminController::class, 'login']);


//Create and Remove Librarian by Admin
Route::middleware('checkAdmin')->group(function () { 
    Route::delete('/admin/remove-librarian', [AdminController::class, 'removeLibrarian']);
    Route::post('/admin/create-librarian', [AdminController::class, 'createLibrarian']);
});


//Get Available books infomration which are not borrowed and taken ---for admin,librarian,user
Route::middleware('checkUserAdminLibrarian')->group(function () { 
    Route::get('/available-books', [BookBorrowingController::class, 'getAvailableBooks']);   //not borrowed
    Route::get('/taken-books', [BookBorrowingController::class, 'getTakenBooks']);  //borrowed books

});
    

//--for admin and librarian
Route::middleware('checkAdminOrLibrarian')->group(function () { 
    //create user
    Route::post('/create-user', [AdminController::class, 'createUser']);  


    //Get borrowed books  of all user or by id 
    Route::get('/borrowed-books', [BookBorrowingController::class, 'getTakenBooks']); 
    Route::post('/borrowed-books/user', [UserController::class, 'getBorrowedBooks']); 

    //Record borrowed book and remove record if book is returned
    Route::post('/librarian/borrow-book', [BookBorrowingController::class, 'borrowBook']);  
    Route::post('/librarian/return-book', [BookReturnController::class, 'returnBook']); 

    //CRUD books in the libarary
    Route::post('/books', [LibrarianController::class, 'createBook']); 
    Route::get('/books', [LibrarianController::class, 'getBooks']); 
    Route::get('/books/{id}', [LibrarianController::class, 'getBook']); 
    Route::put('/books/{id}', [LibrarianController::class, 'updateBook']); 
    Route::delete('/books/{id}', [LibrarianController::class, 'deleteBook']); 

});
    

//Get borrowed book by user validating it's id and token(cannot check of other user) --for user
Route::middleware('checkUser')->group(function () { 
Route::post('/user/borrowed-books', [UserController::class, 'getBorrowedBooks']);
});


