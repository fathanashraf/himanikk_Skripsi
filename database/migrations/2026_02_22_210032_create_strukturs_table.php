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
        Schema::create('strukturs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('jabatan',['kahim', 'wakahim', 'sekretaris', 'bendahara',])->nullable();
            $table->string('avatar')->nullable();
            $table->enum('posisi',['koordinator', 'anggota'])->nullable();
            $table->enum('departemen',['kwu','minatbakat','pemberdaya_wanita', 'humas', 'kaderisasi', 'kominfo', 'keagamaan', 'sosial'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strukturs');
    }
};
