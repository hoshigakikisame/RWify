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
        Schema::create('tb_rukun_warga', function (Blueprint $table) {
            $table->id('id_rukun_warga');
            $table->unsignedSmallInteger('nomor_rukun_warga')->unique();
            $table->text('alamat');
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrentOnUpdate()->nullable();

            // Foreign key
            $table->string('nik_ketua_rukun_warga', 16)->nullable();
            $table->foreign('nik_ketua_rukun_warga')->references('nik')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_rukun_warga');
    }
};
