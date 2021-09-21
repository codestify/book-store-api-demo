<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'local_name' => 'biography',
            'local_display_name' => 'Biography',
            'ebay_name' => 'art_biography',
            'ebay_display_name' => 'Art/Biography',
            'amazon_name' => 'art_biography',
            'amazon_display_name' => 'Art/Biography',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
