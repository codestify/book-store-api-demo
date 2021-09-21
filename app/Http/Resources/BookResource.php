<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price / 100,
            'currency' => 'GBP',
            'quantity' => (int) $this->quantity,
            'image_url' => $this->image_url,
            'tags' => new TagResource($this->whenLoaded('tag')),
            'author' => new AuthorResource($this->whenLoaded('author')),
            'book_type' => new TagResource($this->whenLoaded('type')),
        ];
    }
}
