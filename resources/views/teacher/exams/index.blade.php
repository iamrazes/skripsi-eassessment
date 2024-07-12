@extends('layouts.app')

@section('title')
    <title>
        Exams - {{ config('app.name') }}</title>
@endsection

@section('content')
    <div class="mt-8 bg-white rounded-lg shadow-button p-4 lg:px-8 lg:py-6 mx-4 lg:mx-0">
        <div class="flex lg:flex-row flex-col justify-between">
            <div class="flex flex-col lg:w-1/2">
                <h1 class="font-semibold text-2xl">Assessments - Exams</h1>
                <p class="lg:text-sm text-xs mt-1">This is your assessment dashboard for exams. Manage all of your exams
                    including
                    drafts, published or completed one. Create new exam using the following button.
                </p>
            </div>
            <div class="flex flex-col gap-y-3 mt-4 lg:mt-0">
                <a href="{{ route('teacher.exams.create') }}"
                    class="bg-accent-1 rounded-lg py-2 px-4 gap-x-3 lg:w-56 text-start font-medium text-white flex hover:bg-gradient-to-r from-accent-1 to-accent-2"><img
                        src="{{ asset('icons/ic_assessment.svg') }}" class="filter-white">Create New Exam</a>
                {{-- <a href="{{ route('teacher.history.index') }}"
                    class="bg-white rounded-lg py-2 px-4 gap-x-3 lg:w-56 text-start font-medium text-accent-1 flex hover:bg-gray-100"><img
                        src="{{ asset('icons/ic_assessment0.svg') }}" class="filter-accent-1">View Exams History</a> --}}
            </div>
        </div>
    </div>

    <div class="mt-8 bg-white shadow-button rounded-lg p-4 lg:px-8 lg:py-6 mx-4 lg:mx-0">
        <div class="flex flex-col">
            <h1 class="font-semibold text-xl flex gap-x-2"><img src="{{ asset('icons/ic_assessment-draft.svg') }}"
                    alt="">Drafts Exams</h1>
            <p class="text-xs lg:text-sm mt-1 lg:w-1/2">These are your exams currently in draft. Click continue to proceed
                filling up the
                questions and answer choices.</p>
            @if ($draftExams->isEmpty())
                <p class="mt-1 text-center py-20 text-sm text-gray-400">You have no drafts at the moment.</p>
            @else
                <div class="grid lg:grid-cols-3 gap-4 mt-4">
                    @foreach ($draftExams as $exam)
                        <div class="bg-gray-100 rounded-lg p-4">
                            <div class="flex flex-col gap-y-2">
                                <h1 class="line-clamp-2 text-lg font-medium h-14">{{ $exam->title }}</h1>
                                <div class="flex gap-x-3 text-sm">
                                    <div class="flex flex-col">
                                        <span>Subject</span>
                                        <span>Classroom</span>
                                        <span>Date Assigned</span>
                                        <span>Status</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span>: {{ $exam->subject->name }}</span>
                                        <span>:
                                            @foreach ($exam->classrooms as $classroom)
                                                {{ $classroom->name }}@if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </span>
                                        <span>: {{ $exam->date->format('d/m/Y') }}</span>
                                        <span>: {{ ucfirst($exam->status) }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('teacher.exams.show', $exam->id) }}"
                                    class="bg-accent-1 rounded-lg text-white font-medium text-center py-2 hover:bg-gradient-to-r from-accent-1 to-accent-2">
                                    Manage Exam & Question
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="mt-8 bg-white shadow-button rounded-lg p-4 lg:px-8 lg:py-6 mx-4 lg:mx-0">
        <div class="flex flex-col">
            <h1 class="font-semibold text-xl flex gap-x-2"><img src="{{ asset('icons/ic_assessment-published.svg') }}"
                    alt="">Published Exams</h1>
            <p class="text-xs lg:text-sm mt-1 lg:w-1/2">These are your published exams, waiting for the assignment from your
                students.</p>

            @if ($publishedExams->isEmpty())
                <p class="mt-1 text-center py-20 text-sm text-gray-400">You have no published exams at the moment.</p>
            @else
                <div class="grid lg:grid-cols-3 gap-4 mt-4">
                    @foreach ($publishedExams as $exam)
                        <div class="bg-gray-100 rounded-lg p-4">
                            <div class="flex flex-col gap-y-2">
                                <h1 class="line-clamp-2 text-lg font-medium h-14">{{ $exam->title }}</h1>
                                <div class="flex gap-x-3 text-sm">
                                    <div class="flex flex-col">
                                        <span>Subject</span>
                                        <span>Classroom</span>
                                        <span>Date Assigned</span>
                                        <span>Start Time</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span>: {{ $exam->subject->name }}</span>
                                        <span>:
                                            @foreach ($exam->classrooms as $classroom)
                                                {{ $classroom->name }}@if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </span>
                                        <span>: {{ $exam->date->format('d/m/Y') }}</span>
                                        <span>: {{ $exam->start_time }} ( {{ $exam->duration }} minutes ) </span>
                                    </div>
                                </div>
                                <a href="{{ route('teacher.exams.show', $exam->id) }}"
                                    class="bg-accent-1 rounded-lg text-white font-medium text-center py-2 hover:bg-gradient-to-r from-accent-1 to-accent-2 ">
                                    Preview
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

@endsection
