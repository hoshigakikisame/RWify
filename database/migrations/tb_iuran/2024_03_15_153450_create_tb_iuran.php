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
        Schema::create('tb_iuran', function (Blueprint $table) {
            $table->id('id_iuran');
            $table->enum('bulan', ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
            $table->unsignedSmallInteger('tahun');
            $table->unsignedMediumInteger('jumlah_bayar');
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrentOnUpdate()->nullable();
            
            // Foreign key
            $table->string('nik_pembayar', 16);
            $table->foreign('nik_pembayar')->references('nik')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('id_pembayaran_iuran');
            $table->foreign('id_pembayaran_iuran')->references('id_pembayaran_iuran')->on('tb_pembayaran_iuran')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_iuran');
    }
};
