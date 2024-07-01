@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Available Exams</h1>
        @if($exams->isEmpty())
            <p>No available exams.</p>
        @else
            <ul>
                @foreach($exams as $exam)
                    <li>
                        <a href="{{ route('students.exams.show', $exam->id) }}">{{ $exam->title }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
