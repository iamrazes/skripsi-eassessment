<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamStudentReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'user_id',
        'score',
        'total_questions'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the additional student data.
     */
    public function studentData()
    {
        return $this->hasOne(DataStudent::class, 'user_id', 'user_id');
    }


}
