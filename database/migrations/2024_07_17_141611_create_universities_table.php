<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('nama_universitas');
            $table->string('gambar_rnm')->nullable();
            $table->string('nama_jurusan');
            $table->integer('nilai_rnm');
            $table->string('url_info_pendaftaran')->nullable();
            $table->string('url_info_passinggrade')->nullable();
            $table->string('url_biaya_pendidikan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('universities');
    }
};
