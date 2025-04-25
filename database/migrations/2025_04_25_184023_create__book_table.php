<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table ->integer('BookID')->unique();
            $table->text('Title');    
            $table->decimal('price',18,2);
            $table->text('Description');
            $table->text('ImgSrc');
            $table->text('Category');
            $table->float('Rating');
            $table->integer('NumberOfReviews');
            $table->decimal('Tax',18,2);
            $table->text('Publisher');
            $table->text('Author')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
