<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->index();                    // app_name, site_title
            $table->text('value')->nullable();                          // Nilai setting
            $table->enum('type', ['string', 'boolean', 'integer', 'json'])->default('string')->index();
            $table->string('group')->nullable()->index();               // general, email, social
            $table->text('description')->nullable();                    // Keterangan
            $table->boolean('is_public')->default(true);                // Public access?
            $table->integer('sort_order')->default('0');                 // Urutan tampilan
            $table->timestamps();
            
            // Composite indexes
            $table->index(['group', 'type']);
            $table->index('is_public');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
