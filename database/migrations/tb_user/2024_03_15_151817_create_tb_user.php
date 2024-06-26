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
        Schema::create("tb_user", function (Blueprint $table) {
            $table->string("nik", 16)->primary();
            $table->string("nkk", 16)->nullable();
            $table->string("image_url")->nullable();
            $table->string("email")->unique();
            $table->string("password", 72);
            $table->string("nama_depan");
            $table->string("nama_belakang");
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->enum("agama", ["Islam", "Kristen", "Katolik", "Hindu", "Budha", "Konghucu"])->nullable();
            $table->enum("status_perkawinan", ["Belum Kawin", "Kawin", "Cerai Hidup", "Cerai Mati"]);
            $table->string("pekerjaan")->nullable();
            $table->enum("role", ["Ketua Rukun Warga", "Ketua Rukun Tetangga", "Warga", "Petugas Keamanan"])->default("Warga");
            $table->enum("jenis_kelamin", ["Laki-laki", "Perempuan"]);
            $table->enum("golongan_darah", ["A", "B", "AB", "O"])->nullable();
            $table->string("alamat");
            $table->timestamp("dibuat_pada")->useCurrent();
            $table->timestamp("diperbarui_pada")->useCurrentOnUpdate()->nullable();
            $table->timestamp("email_verified_at")->default(null)->nullable();

            // Foreign key
            // $table->foreignId("id_rukun_tetangga")->references("id_rukun_tetangga")->on("tb_rukun_tetangga")->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_user');
    }
};
