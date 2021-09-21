<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::get('books/{book}', [\App\Http\Controllers\BooksController::class, 'show']);
});
 // Endpoints
 //Get book by id
 // Create a book
 // Update a book
 // List books by author
