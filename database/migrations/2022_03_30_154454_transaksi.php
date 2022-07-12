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
            $table->id('id_transaksi');
            $table->String('custom_id');
            $table->Date('tgl_transaksi');
            $table->Date('tgl_pengembalian')->nullable();
            $table->Date('tgl_mulai');
            $table->Date('tgl_selesai');
            $table->Integer('biaya');
            $table->Integer('denda')->nullable();
            $table->Integer('rating');
            $table->String('jenis_transaksi');
            $table->String('metode_pembayaran');
            $table->String('bukti_pembayaran');
            $table->String('verifikasi_pembayaran');
            $table->String('verifikasi_dokumen');
            $table->String('id_customer');
            $table->unsignedBigInteger('id_aset');
            $table->unsignedBigInteger('id_promo')->nullable();
            $table->String('id_pegawai')->nullable();
            $table->String('id_driver')->nullable();
            $table->foreign('id_customer')->references('custom_id')->on('customer');
            $table->foreign('id_aset')->references('id')->on('aset');
            $table->foreign('id_pegawai')->references('custom_id')->on('pegawai');
            $table->foreign('id_driver')->nullable()->references('custom_id')->on('driver');
            $table->foreign('id_promo')->nullable()->references('id')->on('promo');
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
        Schema::dropIfExists('driver');
    }
};
