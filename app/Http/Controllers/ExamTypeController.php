<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    public function index()
    {
        $examTypes = ExamType::all();
        return view('admin.exam-types.index', compact('examTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:exam_types,name',
        ]);

        ExamType::create($request->all());
        return redirect()->route('admin.exam-types.index')->with('success', 'Exam Type created successfully.');
    }

    public function edit(ExamType $examType)
    {
        return view('admin.exam-types.edit', compact('examType'));
    }

    public function update(Request $request, ExamType $examType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:exam_types,name,' . $examType->id,
        ]);

        $examType->update($request->all());
        return redirect()->route('admin.exam-types.index')->with('success', 'Exam Type updated successfully.');
    }

    public function destroy(ExamType $examType)
    {
        $examType->delete();
        return redirect()->route('admin.exam-types.index')->with('success', 'Exam Type deleted successfully.');
    }
}
