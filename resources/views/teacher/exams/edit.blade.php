@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Exam</h1>
        <form action="{{ route('teacher.exams.update', $exam->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="exam_type_id">Exam Type</label>
                <select name="exam_type_id" id="exam_type_id" class="form-control">
                    @foreach ($examTypes as $examType)
                        <option value="{{ $examType->id }}" {{ $exam->exam_type_id == $examType->id ? 'selected' : '' }}>
                            {{ $examType->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="subject_id">Subject</label>
                <select name="subject_id" id="subject_id" class="form-control">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ $exam->subject_id == $subject->id ? 'selected' : '' }}>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ $exam->date }}" min="{{ now()->toDateString() }}">
            </div>
            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $exam->start_time }}">
            </div>
            <div class="form-group">
                <label for="duration">Duration (in minutes)</label>
                <input type="number" name="duration" id="duration" class="form-control" value="{{ $exam->duration }}" min="1">
            </div>
            <div class="form-group">
                <label for="total_questions">Total Questions</label>
                <input type="number" name="total_questions" id="total_questions" class="form-control" value="{{ $exam->total_questions }}" min="1" max="100">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $exam->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="classrooms">Classrooms</label>
                <select name="classrooms[]" id="classrooms" class="form-control" multiple>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" {{ in_array($classroom->id, $exam->classrooms->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $classroom->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Exam</button>
        </form>
    </div>
@endsection
