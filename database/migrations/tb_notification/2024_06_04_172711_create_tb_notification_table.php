<?php

use App\Enums\User\UserRoleEnum;
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
        Schema::create('tb_notification', function (Blueprint $table) {
            $table->id('id_notification');
            $table->string('target_nik', 16)->nullable();
            $table->foreign('target_nik')->references('nik')->on('tb_user')->onUpdate('cascade')->onDelete('cascade');
            $table->text('pesan');
            $table->string('slug');
            $table->timestamp('dibaca_pada')->nullable();
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrentOnUpdate()->nullable();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_notification');
    }
};
