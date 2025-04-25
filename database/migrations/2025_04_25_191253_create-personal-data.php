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
        //
        Schema::create("personalData", function (Blueprint $table) {
            $table->id();
            $table->string("firstName")->nullable(true);
            $table->string("lastName")->nullable(true);
            $table->string("userName")->nullable(true);
            $table->string("email")->nullable(true);
            $table->string("address")->nullable(true);
            // $table->string("phone")->nullable(true);
            $table->string("state")->nullable(true);
            $table->string("country")->nullable(true);
            $table->string("ChooseTheDay")->nullable(true);
            $table->string("nameOnCard")->nullable(true);
            $table->string("creditCardNumber")->nullable(true);
            $table->string("Payment")->nullable(true);
            $table->timestamps();   
            
            //foriegn keys
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
   public function down(): void
    {
        Schema::dropIfExists('personalData');
    }
};
