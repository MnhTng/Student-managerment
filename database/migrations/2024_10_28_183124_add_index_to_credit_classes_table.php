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
        Schema::table('credit_classes', function (Blueprint $table) {
            $table->index(['msv', 'school_year'], 'idx_credit_classes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('credit_classes', function (Blueprint $table) {
            $table->dropIndex('idx_credit_classes');
        });
    }
};
