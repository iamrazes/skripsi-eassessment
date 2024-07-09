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
        Schema::create('exam_student_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('student_id'); // This will reference the 'user_id' in the 'users' table
            $table->unsignedBigInteger('question_id');
            $table->json('selected_choices'); // Assuming selected_choices is stored as JSON
            $table->timestamps();

            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade'); // Reference 'users' table
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_student_answers');
    }
};
