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
        Schema::create('tb_pembayaran_iuran', function (Blueprint $table) {
            $table->id('id_pembayaran_iuran');
            $table->date('tanggal_bayar');
            $table->text('image_url');
            $table->text('keterangan');
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrentOnUpdate()->nullable();

            // Foreign key
            $table->string('nik_pembayar', 16);
            $table->foreign('nik_pembayar')->references('nik')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pembayaran_iuran');
    }
};
