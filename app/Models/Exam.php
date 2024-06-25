<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exam extends Model
{
    protected $fillable = [
        'title', 'exam_type_id', 'subject_id', 'date', 'start_time',
        'duration', 'total_questions', 'description', 'teacher_id', 'status'
    ];

    protected $dates = ['date', 'start_time'];

    protected $casts = [
        'date' => 'date',
    ];

    public function examType(): BelongsTo
    {
        return $this->belongsTo(ExamType::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function classrooms(): BelongsToMany
    {
        return $this->belongsToMany(Classroom::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
