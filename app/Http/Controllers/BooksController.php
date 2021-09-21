<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\BookService;

class BooksController extends Controller
{
    /**
     * @var BookService
     */
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function show(Book $book)
    {
        $book->load('author', 'type', 'tag');
        return $this->bookService->get($book);
    }
}
