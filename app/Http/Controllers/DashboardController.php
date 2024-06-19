<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{

    public function index()
    {

        // Get statistics
        $totalStudents = $this->getTotalStudents();
        $maleStudents = $this->getGenderCount('Male');
        $femaleStudents = $this->getGenderCount('Female');
        $totalTeachers = $this->getTotalTeachers();

        // Return dashboard view with statistics data
        return view('dashboard', compact('totalStudents', 'maleStudents', 'femaleStudents', 'totalTeachers'));
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
