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
        Schema::create('tb_laporan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->string('judul');
            $table->text('konten');
            $table->enum('status', ['Baru', 'Dalam Proses', 'Valid', 'Invalid', 'Selesai'])->default('Baru');
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrentOnUpdate()->nullable();

            // Foreign key
            // $table->foreignId('nik_pelapor')->references('nik')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nik_pelapor', 16);
            $table->foreign('nik_pelapor')->references('nik')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_laporan');
    }
};
