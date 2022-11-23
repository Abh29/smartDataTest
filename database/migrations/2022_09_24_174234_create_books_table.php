<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->bigInteger('author_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('cover_picture')->nullable()->default('storage/static_images/book_placeholder.png');
            $table->string('publisher')->nullable();
            $table->string('edition')->nullable();
            $table->date('printed_at')->nullable();
            $table->integer('rating')->default(3);
            $table->string('language')->default('en');
            $table->integer('pages_count')->unsigned()->nullable();
            $table->longText('book_text')->default("text");
            $table->timestamps();

            $table->index('title');
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
};
