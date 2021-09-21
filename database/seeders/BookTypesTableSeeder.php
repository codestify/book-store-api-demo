<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_types')->insert($this->types());
    }


    public function types(): array
    {
        return [

            [
                'type' => 'hardcover',
                'name' => 'Hardcover',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'e-book',
                'name' => 'Ebook',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'audio-book',
                'name' => 'Audi book',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ];
    }
}
