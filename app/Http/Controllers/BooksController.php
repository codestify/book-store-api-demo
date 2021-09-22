<?php

namespace App\Http\Controllers;

use App\Events\OmniChannelRequest;
use App\Http\Requests\CreateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;

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

    public function update(Book $book, Request $request)
    {
        return $this->bookService->update($book, $request);
    }

    public function store(CreateBookRequest $request)
    {
        $book = $request->persist();

        if ($request->input('omni_channel')){
            OmniChannelRequest::dispatch(
                $request->input('omni_channel'),
                $book
            );
        }

        return $this->bookService->create($book);
    }
}
