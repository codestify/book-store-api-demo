<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tag_id')->index();
            $table->foreignId('author_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('type_id')->index();
            $table->string('title');
            $table->text('description');
            $table->integer('price');
            $table->integer('quantity');
            $table->string('image_url');
            $table->timestamps();

            $table->foreign('tag_id')
                ->references('id')
                ->on('market_places_tags')
                ->onDelete('cascade');

            $table->foreign('type_id')
                ->references('id')
                ->on('book_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
