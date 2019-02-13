<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
             $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_no')->unique()->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('parmanent_address')->nullable();
            $table->string('present_address')->nullable();
            $table->string('rank');
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
        Schema::dropIfExists('teachers');
    }
}
