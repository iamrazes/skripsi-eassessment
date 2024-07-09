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
        Schema::create('exam_student_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('student_id'); // This references the 'user_id' in the 'users' table
            $table->json('student_answers'); // Store student's answers for each question
            $table->json('correct_answers'); // Store correct answers for each question
            $table->integer('score'); // Store the score obtained by the student
            $table->timestamps();

            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade'); // Reference 'users' table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_student_reports');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
};
