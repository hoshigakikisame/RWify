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
        Schema::create('tb_umkm', function (Blueprint $table) {
            $table->id('id_umkm');
            $table->string('nama');
            $table->text('image_url')->nullable();
            $table->string('nama_pemilik');
            $table->string('alamat');
            $table->text('map_url')->nullable();
            $table->string('telepon')->nullable();
            $table->string('instagram_url')->nullable();
            $table->text('deskripsi');
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_umkm');
    }
};
