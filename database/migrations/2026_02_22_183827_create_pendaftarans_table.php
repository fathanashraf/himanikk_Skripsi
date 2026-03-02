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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->enum('status',['proses', 'diterima', 'ditolak'])->default('proses');
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->string('bukti')->nullable();
            $table->string('keterangan')->nullable();
           
             $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            
            $table->foreignId('kegiatan_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            
            $table->foreignId('event_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            
            $table->foreignId('acara_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
