<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactorySamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factory_samples', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sample_id');
            $table->integer('supplier_id');
            $table->date('recieved_date')->nullable();
            $table->string('batch_no')->nullable();
            $table->float('sample_fee')->nullable();
            $table->string('details',1000)->nullable();
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
        Schema::dropIfExists('factory_samples');
    }
}
