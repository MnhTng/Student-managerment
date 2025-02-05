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
        Schema::create('scores', function (Blueprint $table) {
            $table->char('msv', 10);
            $table->char('subject_code', 10);
            $table->string('school_year');
            $table->decimal('score', 4, 2);

            $table->foreign('msv')->references('msv')->on('students')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('subject_code')->references('subject_code')->on('subjects')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('school_year')->references('slug')->on('school_years')->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['msv', 'subject_code', 'school_year']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
