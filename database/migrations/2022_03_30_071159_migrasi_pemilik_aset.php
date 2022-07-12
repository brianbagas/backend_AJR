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
        Schema::create('pemilik_aset', function (Blueprint $table) {
            $table->id();
            $table->String('nama');
            $table->String('no_ktp');
            $table->String('alamat');
            $table->String('no_telp');
            $table->Integer('waktu_kontrak');
            $table->date('mulai_kontrak');
            $table->date('selesai_kontrak');
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
        Schema::dropIfExists('pemilik_aset');
    }
};
