<?php

namespace Database\Factories;

use App\Models\BookType;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookType::class;

    private $lookUpTable = [
        'audio-book' => 'Audi book',
        'e-book' => 'Ebook',
        'hardcover' => 'HardCover'
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomElement = array_rand($this->lookUpTable);

        return [
            'type' => $randomElement,
            'name' => $this->lookUpTable[$randomElement],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
