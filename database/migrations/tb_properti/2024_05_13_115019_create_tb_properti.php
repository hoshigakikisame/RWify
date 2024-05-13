<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_properti', function (Blueprint $table) {
            $table->id('id_properti');
            $table->string('nama_properti', 255);
            $table->unsignedBigInteger('id_tipe_properti');
            $table->foreign('id_tipe_properti')->references('id_tipe_properti')->on('tb_tipe_properti')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nik_pemilik', 16);
            $table->foreign('nik_pemilik')->references('nik')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
            $table->text('alamat');
            $table->unsignedMediumInteger('luas_tanah');
            $table->unsignedMediumInteger('luas_bangunan');
            $table->unsignedMediumInteger('jumlah_kamar');
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_properti');
    }
};
