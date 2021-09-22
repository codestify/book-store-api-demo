<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookType;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function it_lists_all_books_for_an_author()
    {
        $author = Author::factory()->create();
        $tag = Tag::factory()->create();
        $bookType = BookType::factory()->create();
        Book::factory()->count(5)->create([
            'tag_id' => $tag->id,
            'author_id' => $author->id,
            'type_id' => $bookType->id
        ]);

        $this->json('GET',"/api/authors/{$author->name}/books")
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'bio',
                    'books'
                ]
            ]);
    }
}
