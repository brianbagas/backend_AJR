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
        Schema::create('pegawai', function (Blueprint $table) {
           $table->id('id_pegawai');
            $table->String('custom_id')->unique();
            $table->String('nama');
            $table->String('alamat');
            $table->Date('tgl_lahir');
            $table->String('gender');
            $table->String('email');
            $table->String('password');
            $table->String('no_telp')->nullable();
            $table->String('foto');
            $table->boolean('status');
            $table->unsignedBigInteger('id_role');
            $table->foreign('id_role')->references('id')->on('role');
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
        Schema::dropIfExists('pegawai');
    }
};
