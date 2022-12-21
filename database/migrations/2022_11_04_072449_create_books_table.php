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
            $table->id('id');
            $table->foreignId('author_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('publisher_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            // $table->string('authorname'); // iki ga perlu
            // $table->string('authoradress');
            $table->integer('year');
            $table->text('description')->nullable();
            $table->string('language')->nullable();
            $table->string('page')->nullable();
            $table->string('weight')->nullable();
            $table->string('width')->nullable();
            $table->string('length')->nullable();
            // $table->string('description')->nullable();
            $table->string('cover')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->string('price');
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
        Schema::dropIfExists('books');
    }
};
