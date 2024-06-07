<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::orderBy('created_at', 'desc')->get();
        return view('admin.classrooms.index', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:classrooms,name',
        ]);

        Classroom::create($request->all());
        return redirect()->route('admin.classrooms.index')->with('success', 'Classroom created successfully.');
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return redirect()->route('admin.classrooms.index')->with('success', 'Classroom deleted successfully.');
    }
}
