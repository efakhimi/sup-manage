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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('cname', 50);
            $table->string('ctell', 50)->nullable();
            $table->string('caddress')->nullable();
            $table->string('techname', 50)->nullable();
            $table->string('techtell', 50)->nullable();
            $table->enum('status', ['فعال','غیرفعال','مسدود']);
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
        Schema::dropIfExists('customers');
    }
};
