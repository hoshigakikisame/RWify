<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\Pengaduan\PengaduanStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_pengaduan', function (Blueprint $table) {
            $table->id('id_pengaduan');
            $table->string('nik_pengadu', 16);
            $table->foreign('nik_pengadu')->references('nik')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
            $table->text('judul');
            $table->text('isi');
            $table->text('image_url');
            $table->enum('status', PengaduanStatusEnum::getValues())->default(PengaduanStatusEnum::BARU);
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrentOnUpdate()->nullable();

            // Foreign key
            // $table->foreign('nik_pengadu')->references('nik')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pengaduan');
    }
};
