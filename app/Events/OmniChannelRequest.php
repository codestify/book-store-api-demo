<?php

namespace App\Events;

use App\Models\Book;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OmniChannelRequest
{
    use Dispatchable, SerializesModels;

    /**
     * @var Book
     */
    public $markets;
    /**
     * @var Book
     */
    public $book;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $markets, Book $book)
    {
        $this->markets = $markets;
        $this->book = $book;
    }

}
