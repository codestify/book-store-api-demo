<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::get('books/{book}', [\App\Http\Controllers\BooksController::class, 'show']);
    Route::patch('books/{book}', [\App\Http\Controllers\BooksController::class, 'update']);
    Route::post('books', [\App\Http\Controllers\BooksController::class, 'store']);
    Route::get('authors/{author}/books', \App\Http\Controllers\AuthorBooksController::class);
});
