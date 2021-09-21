<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketPlacesTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_places_tags', function (Blueprint $table) {
            $table->id();
            $table->string('local_name');
            $table->string('local_display_name');
            $table->string('ebay_name');
            $table->string('ebay_display_name');
            $table->string('amazon_name');
            $table->string('amazon_display_name');

            $table->index(['local_name','ebay_name','amazon_name']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market_places_tags');
    }
}
