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
        Schema::create('tb_tipe_properti', function (Blueprint $table) {
            $table->id('id_tipe_properti');
            $table->string('nama_tipe', 50);
            $table->unsignedMediumInteger('iuran_per_bulan');
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // set foreign key check to 0
        Schema::table('tb_properti', function (Blueprint $table) {
            $table->dropForeign(['id_tipe_properti']);
        });
        Schema::dropIfExists('tb_tipe_properti');
    }
};
