<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardStudentController extends Controller
{

    public function assessments()
    {
        //
        return view('student.assessments');
    }
    public function results()
    {
        //
        return view('student.results');
    }
}
