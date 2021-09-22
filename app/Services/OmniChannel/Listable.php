<?php

namespace App\Services\OmniChannel;

use App\Models\Book;

interface Listable
{
    public function list(Book $book);
}
