<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamStudentReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'student_id',
        'student_answers',
        'correct_answers',
        'score'
    ];

    protected $casts = [
        'student_answers' => 'array',
        'correct_answers' => 'array',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

}
