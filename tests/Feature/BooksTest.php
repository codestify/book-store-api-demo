<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookType;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function it_can_retrieve_a_book_by_id()
    {
        $book = Book::factory()->create();
        $this->get("/api/books/{$book->id}")
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'description',
                    'price',
                    'currency',
                    'quantity',
                    'image_url',
                    'tags',
                    'author',
                    'book_type',
                ]
            ]);

    }


    protected function createBook()
    {
        $author = Author::factory()->create();
        $tag = Tag::factory()->create();
        $bookType = BookType::factory()->create();

        Book::factory()->create([
            'tag_id' => $tag->id,
            'author_id' => $author->id,
            'type_id' => $bookType->id
        ]);
    }
}
