<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tag_id' => $this->faker->randomElement(range(1, 3)),
            'author_id' => $this->faker->randomElement(range(1, 5)),
            'type_id' => $this->faker->randomElement(range(1, 3)),
            'title' => $this->faker->word,
            'description' => $this->faker->realText,
            'price' => $this->faker->randomElement(range(10000,8000)),
            'quantity' => $this->faker->randomElement(range(5,15)),
            'image_url' => $this->faker->imageUrl
        ];
    }
}
