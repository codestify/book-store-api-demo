<?php

namespace Tests\Feature;

use App\Events\OmniChannelRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookType;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class BooksTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function it_can_retrieve_a_book_by_id()
    {
        $author = Author::factory()->create();
        $tag = Tag::factory()->create();
        $bookType = BookType::factory()->create();
        $book = Book::factory()->create([
            'tag_id' => $tag->id,
            'author_id' => $author->id,
            'type_id' => $bookType->id
        ]);

        $this->json('GET', "/api/books/{$book->id}")
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

    /** @test * */
    public function it_can_successfully_update_a_book()
    {
        $author = Author::factory()->create();
        $tag = Tag::factory()->create();
        $bookType = BookType::factory()->create();
        $book = Book::factory()->create([
            'tag_id' => $tag->id,
            'author_id' => $author->id,
            'type_id' => $bookType->id
        ]);

        $new_title = 'New test title';
        $new_description = 'test description';
        $new_price = 27.5;

        $this->json('PATCH', "/api/books/{$book->id}", [
            'title' => $new_title,
            'description' => $new_description,
            'price' => $new_price
        ])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'title' => $new_title,
                    'description' => $new_description,
                    'price' => $new_price
                ]
            ]);
    }

    /** @test * */
    public function it_can_successfully_create_a_book()
    {
        $author = Author::factory()->create();
        $tag = Tag::factory()->create();
        $bookType = BookType::factory()->create();

        $new_book_data = [
            'tag' => $tag->local_name,
            'author' => $author->name,
            'type' => $bookType->type,
            'title' => 'Test Book',
            'description' => 'Test Description',
            'price' => 25.50,
            'quantity' => 30,
            'image_url' => 'https://via.placeholder.com/640x480.png/008800?text=veniam'
        ];

        $this->json('POST', 'api/books', Arr::except($new_book_data,'author'))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->json('POST', 'api/books', $new_book_data)
            ->assertStatus(Response::HTTP_CREATED)
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

    /** @test * */
    public function it_can_successfully_create_a_book_and_publish_to_other_market_places()
    {
        $author = Author::factory()->create();
        $tag = Tag::factory()->create();
        $bookType = BookType::factory()->create();
        Event::fake();

        $new_book_data = [
            'tag' => $tag->local_name,
            'author' => $author->name,
            'type' => $bookType->type,
            'title' => 'Test Book',
            'description' => 'Test Description',
            'price' => 25.50,
            'quantity' => 30,
            'image_url' => 'https://via.placeholder.com/640x480.png/008800?text=veniam',
            'omni_channel' => 'amazon,ebay'
        ];

        $this->json('POST', 'api/books', $new_book_data)
            ->assertStatus(Response::HTTP_CREATED)
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

        Event::assertDispatched(OmniChannelRequest::class);

    }
}
