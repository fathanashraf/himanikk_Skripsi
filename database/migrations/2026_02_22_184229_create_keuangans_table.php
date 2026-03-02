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
        Schema::create('keuangans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nominal');
            $table->date('tanggal');
            $table->enum('type', ['pendapatan', 'bantuan', 'lainnya'])->default('lainnya');
            
            // ✅ Foreign Keys - Nullable & Safe
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
            
            $table->foreignId('pendaftaran_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            
            $table->enum('jenis', ['pendapatan', 'pengeluaran'])->default('pendapatan');
            $table->string('total');
            $table->text('keterangan')->nullable(); 
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangans');
    }
};
