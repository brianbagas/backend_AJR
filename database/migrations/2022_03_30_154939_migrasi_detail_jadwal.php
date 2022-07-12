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
        Schema::create('detail_jadwal', function (Blueprint $table) {
            $table->String('Keterangan')->nullable();
            $table->unsignedBigInteger('id_jadwal');
            $table->unsignedBigInteger('id_pegawai');
            $table->foreign('id_jadwal')->references('id')->on('jadwal');
            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawai');
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
        Schema::dropIfExists('detail_jadwal');
    }
};
