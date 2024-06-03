<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DataAdmin extends Model
{

    protected $fillable = [
        'user_id', 'contact', 'address', 'nuptk', 'nip'
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
