<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->date('cotract_date');
            $table->string('cotract_no')->unique();
            $table->string('payment_mode')->nullable();
            $table->string('currency')->nullable();
            $table->float('contract_amount')->nullable();
            $table->string('goods_description',1000)->nullable();
            $table->date('estimated_shipping_date')->nullable();
            $table->date('estimated_arrival_date')->nullable();
            $table->date('shipping_date')->nullable();
            $table->date('arrival_date')->nullable();
            $table->date('first_collection_date')->nullable();
            $table->float('first_collection_amount')->nullable();
            $table->float('first_exchange_rate',8,4)->nullable();
            $table->date('second_collection_date')->nullable();
            $table->float('second_collection_amount')->nullable();
            $table->float('second_exchange_rate',8,4)->nullable();
            $table->integer('royalty_rate')->nullable();
            $table->float('royalty_amount')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('remarks',1000)->nullable();
            $table->boolean('passed')->default(false);
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
