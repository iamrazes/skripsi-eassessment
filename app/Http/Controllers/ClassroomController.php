<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::orderBy('name')->get();
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

    public function show(Classroom $classroom)
    {
        $classroom->load(['students.user' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        return view('admin.classrooms.show', compact('classroom'));
    }

    public function edit(Classroom $classroom)
    {
        return view('admin.classrooms.edit', compact('classroom'));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:classrooms,name,' . $classroom->id,
        ]);

        $classroom->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.classrooms.index')->with('success', 'Classroom updated successfully.');
    }
}
