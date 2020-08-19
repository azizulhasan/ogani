<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColummsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('contact')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('age')->nullable();
            $table->bigInteger('country_id')->unsigned()->index()->nullable();
            $table->bigInteger('city_id')->unsigned()->index()->nullable();
            $table->bigInteger('roll_id')->unsigned()->index()->nullable();
            $table->string('picture', 150)->nullable();
            $table->string('address', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
