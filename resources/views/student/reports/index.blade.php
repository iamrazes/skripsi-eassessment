@extends('layouts.app')

@section('content')
    <h1>Exam Reports</h1>

    @foreach ($reports as $report)
        <div>
            <p>Exam Title: {{ $report->exam->title }}</p>
            <p>Score: {{ $report->score }}</p>

        </div>
        <hr>
    @endforeach
@endsection
