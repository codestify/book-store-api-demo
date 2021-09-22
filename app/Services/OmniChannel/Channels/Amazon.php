<?php

namespace App\Services\OmniChannel\Channels;

use App\Models\Book;
use App\Services\OmniChannel\Listable;
use Illuminate\Support\Facades\Log;

class Amazon implements Listable
{

    public function list(Book $book)
    {
        // Implement logic to publish on Amazon
        Log::info('Publishing to Amazon');
    }
}
