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
        Schema::create('students', function (Blueprint $table) {
            $table->char('msv', 10)->primary();
            $table->string('name', 100);
            $table->date('birthday');
            $table->enum('gender', ['Nam', 'Nữ']);
            $table->string('address', 100);
            $table->char('phone', 15);
            $table->string('email', 100)->unique();
            $table->char('cccd', 12);
            $table->string('ethnicity', 30)->nullable();
            $table->char('class_code', 15);
            $table->char('faculty_code', 10);
            $table->char('major_code', 10);
            $table->char('training_code', 10);
            $table->char('academic_year', 10);

            $table->foreign('class_code')->references('class_code')->on('formal_classes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('faculty_code')->references('faculty_code')->on('faculties')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('major_code')->references('major_code')->on('majors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('training_code')->references('training_code')->on('training_systems')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};