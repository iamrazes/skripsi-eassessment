<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DataTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DataTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataTeachers = DataTeacher::all();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->get();

        return view('admin.data-teachers.index', compact('dataTeachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data-teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // Validate the incoming request data
    $request->validate([
        'username' => 'required|string|unique:users',
        'name' => 'required|string',
        'email' => 'nullable|string|email|unique:users',
        'password' => 'required|string|confirmed',
        'contact' => 'nullable|string',
        'address' => 'nullable|string',
        'nuptk' => 'nullable|string',
        'nip' => 'nullable|string',
    ]);

    // Create the user
    $user = User::create([
        'username' => $request->username,
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Assign the user role
    $user->assignRole('teacher');

    // Create the associated teacher data
    $teacher = DataTeacher::create([
        'user_id' => $user->id,
        'contact' => $request->contact,
        'address' => $request->address,
        'nuptk' => $request->nuptk,
        'nip' => $request->nip,
    ]);

    // Redirect back with success message
    return redirect()->route('admin.data-teachers.index')->with('success', 'Teacher data created successfully.');
    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    {

        $teacher = DataTeacher::findOrFail($id);

        return view('admin.data-teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */


    public function edit($id)
    {
        $dataTeacher = DataTeacher::findOrFail($id);
        $user = $dataTeacher->user;

        return view('admin.data-teachers.edit', compact('dataTeacher', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    $dataTeacher = DataTeacher::findOrFail($id);
    $user = $dataTeacher->user;

    $validatedData = $request->validate([
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'name' => 'required|string|max:255',
        'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'contact' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'teacher_id' => 'nullable|string|max:255',
    ]);

    // Update the user
    $user->update([
        'username' => $validatedData['username'],
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
    ]);

    if ($request->filled('password')) {
        $user->update(['password' => Hash::make($validatedData['password'])]);
    }

    // Update the dataTeacher
    $dataTeacher->update([
        'contact' => $validatedData['contact'],
        'address' => $validatedData['address'],
        'teacher_id' => $validatedData['teacher_id'],
    ]);

    return redirect()->route('admin.data-teachers.index')->with('success', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id)
     {
         $teacher = DataTeacher::findOrFail($id);

         // Optionally, delete the associated user
         $user = User::find($teacher->user_id);
         if ($user) {
             $user->delete();
         }

         // Delete the teacher record
         $teacher->delete();

         return redirect()->route('admin.data-teachers.index')->with('success', 'Teacher deleted successfully.');
     }

}
