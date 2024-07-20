<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DataTeacher;
use App\Models\DataAdmin;
use App\Models\DataStudent;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\ExamType;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        // Get statistics
        $totalStudents = $this->getTotalStudents();
        $maleStudents = $this->getGenderCount('Male');
        $femaleStudents = $this->getGenderCount('Female');
        $totalTeachers = $this->getTotalTeachers();
        $dataStudent = DataStudent::where('user_id', $user->id)->first();
        $subjects = Subject::all();
        $classrooms = Classroom::all();

        $exams = Exam::with(['examType', 'subject'])
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();

        $dataTeachers = DataTeacher::all();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->get();

        $now = Carbon::now();
        $daysInMonth = $now->daysInMonth;
        $firstDayOfMonth = $now->copy()->startOfMonth()->dayOfWeek;
        $currentDay = $now->day;


        // Return dashboard view with statistics data
        return view('dashboard', compact('totalStudents', 'maleStudents', 'femaleStudents', 'totalTeachers', 'dataStudent', 'subjects', 'classrooms', 'now', 'daysInMonth', 'firstDayOfMonth', 'currentDay', 'exams', 'dataTeachers'));
    }
    private function getTotalStudents()
    {
        // Get the 'student' role
        $studentRole = Role::where('name', 'student')->first();

        if ($studentRole) {
            // Count users with the 'student' role
            return $studentRole->users()->count();
        } else {
            return 0; // Default to 0 if 'student' role does not exist
        }
    }

    private function getGenderCount($gender)
    {
        // Get the 'student' role
        $studentRole = Role::where('name', 'student')->first();

        if ($studentRole) {
            // Count users with the 'student' role and specific gender
            return $studentRole->users()->whereHas('dataStudent', function ($query) use ($gender) {
                $query->where('gender', $gender);
            })->count();
        } else {
            return 0; // Default to 0 if 'student' role does not exist
        }
    }

    private function getTotalTeachers()
    {
        // Get the 'teacher' role
        $teacherRole = Role::where('name', 'teacher')->first();

        if ($teacherRole) {
            // Count users with the 'teacher' role
            return $teacherRole->users()->count();
        } else {
            return 0; // Default to 0 if 'teacher' role does not exist
        }
    }
}
