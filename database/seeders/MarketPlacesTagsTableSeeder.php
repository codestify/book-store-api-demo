<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketPlacesTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('market_places_tags')->insert($this->tags());
    }

    public function tags()
    {
        return [
            [
                'local_name' => 'action',
                'local_display_name' => 'Action',
                'ebay_name' => 'adventure',
                'ebay_display_name' => 'Adventure',
                'amazon_name' => 'action_adventure',
                'amazon_display_name' => 'Action & Adventure',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'local_name' => 'biography',
                'local_display_name' => 'Biography',
                'ebay_name' => 'art_biography',
                'ebay_display_name' => 'Art/Biography',
                'amazon_name' => 'art_biography',
                'amazon_display_name' => 'Art/Biography',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'local_name' => 'economics',
                'local_display_name' => 'Economics',
                'ebay_name' => 'business',
                'ebay_display_name' => 'Business',
                'amazon_name' => 'business_economics',
                'amazon_display_name' => 'Business/Economics',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
    }
}
