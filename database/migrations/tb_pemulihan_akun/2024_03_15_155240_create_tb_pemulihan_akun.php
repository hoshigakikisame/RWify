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
        // commented for now
        // Schema::create('tb_verifikasi_akun', function (Blueprint $table) {
        //     $table->id('id_verifikasi_akun');
        //     $table->string('token', 32);
        //     $table->datetime('valid_hingga');
        //     $table->timestamp('dibuat_pada')->useCurrent();
        //     $table->timestamp('diperbarui_pada')->useCurrentOnUpdate()->nullable();

        //     // Foreign keys
        //     // $table->foreignId('nik')->references('nik')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
        //     $table->string('nik', 16);
        //     $table->foreign('nik')->references('nik')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pemulihan_akun');
    }
};
