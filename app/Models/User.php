<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function dataAdmin()
    {
        return $this->hasOne(DataAdmin::class);
    }

    public function dataStudent()
    {
        return $this->hasOne(DataStudent::class);
    }

    public function dataTeacher()
    {
        return $this->hasOne(DataTeacher::class);
    }

    public function studentReports()
    {
        return $this->hasMany(ExamStudentReport::class, 'student_id');
    }
}
