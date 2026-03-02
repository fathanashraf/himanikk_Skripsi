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
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('singkatan');
            $table->text('sejarah');
            $table->string('alamat');
            $table->string('email');
            $table->string('fungsi');
            $table->string('tujuan');
            $table->string('logo')->nullable();
            $table->string('visi')->nullable();
            $table->string('misi')->nullable();
            $table->string('motto')->nullable();
            $table->string('AD/ART')->nullable();
            $table->string('lagu')->nullable();
            $table->string('instrumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};
