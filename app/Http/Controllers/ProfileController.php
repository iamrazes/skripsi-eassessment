<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataStudent;

class ProfileController extends Controller
{

    public function show()
    {
        $user = Auth::user();
        $dataStudent = DataStudent::where('user_id', $user->id)->first();

        return view('profile', compact('user', 'dataStudent'));
    }
}
