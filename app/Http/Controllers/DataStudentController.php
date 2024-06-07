<?php

namespace App\Http\Controllers;

use App\Models\DataStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataStudentController extends Controller
{
    //
    public function index()
    {
        $dataStudents = DataStudent::with('user')->get();
        return view('admin.data-students.index', compact('dataStudents'));
    }

    public function create()
    {
        return view('admin.data-students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string|in:male,female',
            'birthdate' => 'required|date',
            'student_id' => 'required|string|unique:data_students,student_id',
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        DataStudent::create([
            'user_id' => $user->id,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'student_id' => $request->student_id,
        ]);

        return redirect()->route('admin.data-students.index')->with('success', 'Student created successfully.');
    }

    public function edit(DataStudent $dataStudent)
    {
        $user = $dataStudent->user;
        return view('admin.data-students.edit', compact('dataStudent', 'user'));
    }

    public function update(Request $request, DataStudent $dataStudent)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $dataStudent->user->id,
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $dataStudent->user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'gender' => 'required|string|in:male,female',
            'birthdate' => 'required|date',
            'student_id' => 'required|string|unique:data_students,student_id,' . $dataStudent->id,
        ]);

        $user = $dataStudent->user;
        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $dataStudent->update([
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'student_id' => $request->student_id,
        ]);

        return redirect()->route('admin.data-students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(DataStudent $dataStudent)
    {
        $dataStudent->user->delete();
        return redirect()->route('admin.data-students.index')->with('success', 'Student deleted successfully.');
    }

    public function show($id)
    {
        $student = DataStudent::findOrFail($id);

        return view('admin.data-students.show', compact('student'));
    }
}
