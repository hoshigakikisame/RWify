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
        Schema::create('tb_pengumuman', function (Blueprint $table) {
            $table->id('id_pengumuman');
            $table->string('judul');
            $table->text('image_url')->nullable();
            $table->text('konten');
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pengumuman');
    }
};
