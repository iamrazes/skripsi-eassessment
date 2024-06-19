<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataStudent;
use App\Models\DataTeacher;
use App\Models\DataAdmin;
use App\Models\Classroom;

class ProfileController extends Controller
{

    public function show()
    {
        $user = Auth::user();

        $dataStudent = DataStudent::where('user_id', $user->id)->first();
        $dataTeacher = DataTeacher::where('user_id', $user->id)->first();
        $dataAdmin = DataAdmin::where('user_id', $user->id)->first();
        return view('profile', compact('user', 'dataStudent', 'dataAdmin', 'dataTeacher'));
    }
}
