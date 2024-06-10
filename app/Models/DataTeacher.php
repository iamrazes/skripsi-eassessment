<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DataTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'contact', 'address', 'teacher_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($dataAdmin) {
            $dataAdmin->user()->delete();
        });
    }
}
