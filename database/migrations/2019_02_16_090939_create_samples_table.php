<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->string('currency')->nullable();
            $table->float('collection_amount')->nullable();
            $table->float('exchange_rate')->nullable();
            $table->string('courier')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('tracking_number')->nullable();
            $table->float('fee')->nullable();
            $table->string('status')->nullable();
            $table->string('details',1000)->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('samples');
    }
}
