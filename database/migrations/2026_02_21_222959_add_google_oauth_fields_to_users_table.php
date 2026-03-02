<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Google OAuth fields
            $table->string('google_id')->nullable()->unique()->after('email');
            $table->string('google_token')->nullable()->after('google_id');
            
            // Status fields
            $table->boolean('is_active')->default(true)->index()->after('google_token');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
            
            // Indexes
            $table->index(['role', 'status']);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'google_token', 'is_active', 'last_login_at']);
        });
    }
};
