<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uname',20)->unique();
            $table->string('password', 60);
            $table->string('fname', 50)->nullable();
            $table->string('lname', 50)->nullable();
            $table->string('job_position', 20)->nullable();
            $table->boolean('active');
            $table->dateTime('last_login', 0)->nullable();
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
        Schema::dropIfExists('users');
    }
};
