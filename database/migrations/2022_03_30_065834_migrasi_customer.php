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
        Schema::create('Customer', function (Blueprint $table) {
            $table->id('id_customer');
            $table->String('custom_id')->unique();
            $table->string('nama_customer');
            $table->string('no_ktp');
            $table->string('password');
            $table->string('SIM')->nullable();
            $table->string('KTP')->nullable();
            $table->string('alamat_customer');
            $table->Date('tgl_lahir_customer');
            $table->string('gender_customer');
            $table->string('no_telp_customer');
            $table->string('email');
            $table->boolean('verifikasi_data');
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
        Schema::dropIfExists('Customer');
    }
};
