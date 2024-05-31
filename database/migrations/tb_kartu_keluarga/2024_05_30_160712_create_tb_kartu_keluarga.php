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
        Schema::create('tb_kartu_keluarga', function (Blueprint $table) {
            $table->string("nkk", 16)->primary();
            $table->foreignId('id_rukun_tetangga')->nullable()->constrained('tb_rukun_tetangga', 'id_rukun_tetangga')->onUpdate('cascade')->onDelete('cascade');
            $table->string('alamat');
            $table->unsignedBigInteger('tagihan_listrik_per_bulan');
            $table->unsignedSmallInteger('jumlah_pekerja');
            $table->unsignedBigInteger('total_penghasilan_per_bulan'); 
            $table->unsignedBigInteger('total_pajak_per_tahun');
            $table->unsignedBigInteger('total_properti_dimiliki');
            $table->unsignedBigInteger('tagihan_air_per_bulan');

            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrentOnUpdate()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_kartu_keluarga');
    }
};
