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
        Schema::create('studio', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('studio', 255);
            $table->string('harga_setting', 255);
            $table->string('harga_shooting', 255);
            $table->string('overcharge_setting', 255);
            $table->string('overcharge_shooting', 255);
            $table->string('luas', 255);
            $table->string('tinggi', 255);
            $table->string('fasilitas', 255);
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
        Schema::dropIfExists('studio');
    }
};
