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
        Schema::create('tb_permintaan_dokumen', function (Blueprint $table) {
            $table->id('id_permintaan_dokumen');
            $table->string('nama_permintaan');
            $table->text('path_dokumen');
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrentOnUpdate()->nullable();

            // Foreign key
            // $table->foreignId('nik_pemohon')->references('nik')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nik_pemohon', 16);
            $table->foreign('nik_pemohon')->references('nik')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_permintaan_dokumen');
    }
};
