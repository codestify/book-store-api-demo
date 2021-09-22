<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Symfony\Component\HttpFoundation\Response;

class AuthorBooksController extends Controller
{

    public function __invoke($author)
    {
        $author = Author::with('books')->where('name', $author)->first();
        if (null === $author){
            return response()->json([
                'message' => "Author doesn't exist"
            ], Response::HTTP_BAD_REQUEST);
        }
        return new AuthorResource($author);
    }
}
