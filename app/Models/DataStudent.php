<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DataStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'gender', 'birthdate', 'student_id', 'classroom_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($dataStudent) {
            $dataStudent->user()->delete();
        });
    }
}
