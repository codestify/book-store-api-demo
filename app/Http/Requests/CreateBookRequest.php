<?php

namespace App\Http\Requests;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookType;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tag' => 'required|exists:market_places_tags,local_name',
            'author' => 'required',
            'type' => 'required|exists:book_types',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image_url' => 'required'
        ];
    }

    public function persist()
    {
        $author = Author::where('name', $this->input('author'))->first();
        if (null === $author) {
            $author = Author::create(['name' => $this->input('author')]);
        }
        $tag = Tag::where('local_name', $this->input('tag'))->first();
        $bookType = BookType::where('type', $this->input('type'))->first();

        $book = Book::create([
            'tag_id' => $tag->id,
            'author_id' => $author->id,
            'type_id' => $bookType->id,
            'title' => $this->input('title'),
            'description' => $this->input('description'),
            'price' => $this->input('price') * 100,
            'quantity' => $this->input('quantity'),
            'image_url' => $this->input('image_url')
        ]);

        $book->load('tag', 'author', 'type');
        return $book;
    }
}
