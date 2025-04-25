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
        Schema::create('shoping_carts_books', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shoping_cart_id')->unsigned();
            $table->foreign('shoping_cart_id')->references('id')->on('shoping_cart')->onDelete('cascade');
            $table->bigInteger('book_id')->unsigned();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->integer('quantity')->default(1)->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shoping_carts_books');
    }
};
