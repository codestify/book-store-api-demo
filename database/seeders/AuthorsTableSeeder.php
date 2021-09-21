<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->insert($this->authors());
    }

    protected function authors()
    {
        $faker = Factory::create();
        $authors = [];
        for ($i = 0; $i <= 5; $i++) {
            $authors[] = [
                'name' => $faker->name,
                'bio' => $faker->realText
            ];
        }
        return $authors;
    }
}
