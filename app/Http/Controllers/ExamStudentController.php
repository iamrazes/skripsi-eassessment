<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamStudentController extends Controller
{
    //

    public function index() {

        return view('student.exams.index');
    }
}
