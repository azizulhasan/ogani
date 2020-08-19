<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('name');
            $table->string('email', 50)->nullable();
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code', 50)->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->foreignId('city_id')->nullable()->constrained('cities');
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
        Schema::dropIfExists('shippings');
    }
}
