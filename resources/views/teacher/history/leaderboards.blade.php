@extends('layouts.app')

@section('title')
    <title>Exam - {{ $exam->title }}</title>
@endsection

@section('content')
    <div class="mx-4 lg:mx-0 lg:mt-8 bg-white rounded-lg shadow-button ">

        <div class="mb-4 pt-4 px-4">
            <form action="{{ route('teacher.history.leaderboards', ['exam' => $exam->id]) }}" method="GET">
                <label for="classroom_id" class="mr-2">Classroom:</label>
                <select name="classroom_id" id="classroom_id" onchange="this.form.submit()" class="h-10">
                    <option value="">All Classrooms</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" {{ $classroomId == $classroom->id ? 'selected' : '' }}>
                            {{ $classroom->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>


        <table class="min-w-full bg-white mt-4 rounded-b-lg mb-4">
            <thead>
                <tr class="text-left bg-gray-100 font-normal">
                    <th class="py-2 w-20 px-2">Rank</th>
                    <th class="py-2">Student Name</th>
                    <th class="py-2 text-end px-2">Classroom</th>
                    <th class="py-2 w-20 px-2 text-center">Score</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($studentReports as $index => $report)
                    <tr class="">
                        <td class="py-2 px-4">{{ $index + 1 }}</td>
                        <td class="py-2 px-4">{{ $report->student->name }}</td>
                        <td class="py-2 px-2 text-end">{{ $report->student->datastudent->classroom->name }}</td>
                        <td class="py-2 px-4 text-center">{{ $report->score }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
