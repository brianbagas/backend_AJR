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
        Schema::create('driver', function (Blueprint $table) {
            $table->id('id_driver');
            $table->String('custom_id')->unique();
            $table->String('nama');
            $table->String('alamat');
            $table->Date('tgl_lahir');
            $table->String('gender');
            $table->String('no_telp');
            $table->String('email');
            $table->String('password');
            $table->String('Bahasa');
            $table->String('foto');
            $table->String('sim');
            $table->String('napza');
            $table->String('jiwa');
            $table->String('jasmani');
            $table->String('skck');
            $table->boolean('status');
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
