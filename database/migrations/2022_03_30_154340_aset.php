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
        Schema::create('aset', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->String('plat_nomor');
            $table->String('stnk');
            $table->String('kategory');
            $table->String('kapasitas');
            $table->String('tipe');
            $table->String('transmisi');
            $table->String('bahanBakar');
            $table->String('volume');
            $table->String('warna');
            $table->string('status');
            $table->string('fasilitas');
            $table->integer('harga');
            $table->unsignedBigInteger('id_pemilik')->nullable();
            $table->unsignedBigInteger('id_brosur');
            $table->foreign('id_brosur')->references('id')->on('brosur');
            $table->foreign('id_pemilik')->nullable()->references('id')->on('pemilik_aset');
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
        Schema::dropIfExists('aset');
    }
};
