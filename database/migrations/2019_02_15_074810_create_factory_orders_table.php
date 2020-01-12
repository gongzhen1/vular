<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactoryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factory_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('supplier_id');
            $table->date('cotract_date');
            $table->string('cotract_no')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('currency')->nullable();
            $table->float('contract_amount')->nullable();
            $table->string('goods_description',1000)->nullable();
            $table->date('estimated_delivery_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('first_pay_date')->nullable();
            $table->float('first_pay_amount')->nullable();
            $table->float('first_pay_exchange_rate', 8,4)->nullable();
            $table->date('second_pay_date')->nullable();
            $table->float('second_pay_amount')->nullable();
            $table->float('second_pay_exchange_rate', 8,4)->nullable();
            $table->string('remarks',1000)->nullable();
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
        Schema::dropIfExists('factory_orders');
    }
}
