<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamStudentAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'student_id',
        'question_id',
        'selected_choices'
    ];

    protected $casts = [
        'selected_choices' => 'array'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function student()
    {
        return $this->belongsTo(DataStudent::class, 'student_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
