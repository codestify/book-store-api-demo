<?php

namespace App\Services;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;

class BookService
{
    /**
     * @var Model Book
     */
    protected $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function get(Book $book)
    {
        return new BookResource($book);
    }

}
