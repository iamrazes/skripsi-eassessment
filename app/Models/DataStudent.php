<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'birthdate',
        'student_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
