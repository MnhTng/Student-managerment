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
        Schema::create('formal_classes', function (Blueprint $table) {
            $table->char('class_code', 15)->primary();
            $table->char('mgv', 10);
            $table->char('major_code', 10);
            $table->foreign('mgv')->references('mgv')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('major_code')->references('major_code')->on('majors')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formal_classes');
    }
};