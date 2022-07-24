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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('users_id');
            $table->string('status_tran');
            $table->date('tanggal');
            $table->string('nama', 255);
            $table->string('email', 255);
            $table->string('no_hp', 255);
            $table->string('nama_per', 255);
            $table->string('email_per', 255);
            $table->string('no_hp_per', 255);
            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users');
        });

        Schema::create('transaksi_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('transaksi_id');
            $table->string('studio', 255);
            $table->string('harga_setting', 255);
            $table->string('harga_shooting', 255);
            $table->string('overcharge_setting', 255);
            $table->string('overcharge_shooting', 255);
            $table->string('durasi_shooting');
            $table->string('durasi_setting');
            $table->string('t_harga');
            $table->date('tanggal');
            $table->timestamps();
            $table->foreign('transaksi_id')->references('id')->on('transaksi');
        });

        Schema::create('tagihan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('transaksi_id');
            $table->foreignUuid('users_id');
            $table->string('jenis'); //ex: dp, pelunasan
            $table->tinyInteger('lunas'); //ex true false
            $table->string('nominal');
            $table->timestamps();
            $table->foreign('transaksi_id')->references('id')->on('transaksi');
            $table->foreign('users_id')->references('id')->on('users');
        });

        Schema::create('pembayaran', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tagihan_id');
            $table->foreignUuid('users_id');
            $table->string('bukti_img');
            $table->string('nominal');
            $table->tinyInteger('verified'); // true or false
            $table->timestamps();
            $table->foreign('tagihan_id')->references('id')->on('tagihan');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
