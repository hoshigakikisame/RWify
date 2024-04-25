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
        Schema::create('tb_reservasi_jadwal_temu', function (Blueprint $table) {
            $table->id('id_reservasi_jadwal_temu');
            $table->string('nik_pemohon', 16);
            $table->string('nik_penerima', 16);
            $table->string('subjek');
            $table->text('pesan');
            $table->timestamp('jadwal_temu')->useCurrent();
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');

            $table->foreign('nik_pemohon')->references('nik')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('nik_penerima')->references('nik')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
