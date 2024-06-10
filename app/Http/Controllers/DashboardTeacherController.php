<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardTeacherController extends Controller
{

    public function create()
    {
        //
        return view('teacher.create-assessment');
    }

    public function examine()
    {
        //
        return view('teacher.examine-assessment');
    }

    public function review()
    {
        //
        return view('teacher.review-assessment');
    }
}
