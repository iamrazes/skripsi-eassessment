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
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|confirmed',
        'contact' => 'nullable|string',
        'address' => 'nullable|string',
        'teacher_id' => 'nullable|string',
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
        'teacher_id' => $request->teacher_id,
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
        $dataAdmin = DataAdmin::findOrFail($id);
        $user = $dataAdmin->user;

        return view('admin.data-admins.edit', compact('dataAdmin', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
