<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login_name')->unique();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->string('password')->nullable();
            $table->datetime('loggedin_at')->nullable();
            $table->string('loggedin_ip')->nullable();
            $table->boolean('forbid')->default(false);
            $table->boolean('issupper')->default(false);
            $table->string('position')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('introduction')->nullable();
            $table->integer('avatar_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
