<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time');
            $table->dateTime('delivery_date')->nullable();
            $table->string('cupon_id')->nullable(); 
            $table->string('payment_info')->nullable();
            $table->string('shipping_status')->nullable();
            $table->foreignId('shippings_id')->nullable()->constrained('shippings');
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('orders');
    }
}
