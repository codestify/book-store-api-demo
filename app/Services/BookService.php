<?php

namespace App\Services;

use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookType;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BookService
{
    /**
     * @var Model Book
     */
    protected $book;

    /**
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * @param Book $book
     * @return BookResource
     */
    public function get(Book $book): BookResource
    {
        return new BookResource($book);
    }

    /**
     * @param Book $book
     * @param Request $request
     * @return BookResource
     */
    public function update(Book $book, Request $request): BookResource
    {
        $attributes = $request->only([
            'title','description','currency','quantity','image_url'
        ]);

        // We are storing money in database as pennies
        if ($request->has('price')){
            $attributes = array_merge($attributes, ['price' => $request->input('price') * 100]);
        }

        // Hitting mysql is an expensive operation, therefore call save method
        // only if any of the data has changed, Otherwise just return the book
        $book->fill($attributes);
        if ($book->isDirty()){
            $book = tap($book)->save();
        }

        $book->load('tag','type','author');

        return new BookResource($book);
    }

    public function create(Book $book): BookResource
    {
        return new BookResource($book);
    }

}
