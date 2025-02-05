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
        Schema::create('credit_classes', function (Blueprint $table) {
            $table->string('room', 20);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->char('mgv', 10);
            $table->char('msv', 10);
            $table->char('subject_code', 10);
            $table->string('school_year');

            $table->foreign('mgv')->references('mgv')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('msv')->references('msv')->on('students')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('subject_code')->references('subject_code')->on('subjects')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('school_year')->references('slug')->on('school_years')->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['msv', 'subject_code', 'start_time', 'end_time']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_classes');
    }
};
