@extends('layouts.app')

@section('content')
    <div class="mx-4 lg:mx-0 lg:mt-8 bg-white rounded-lg shadow-button">
        <div class="flex flex-col">
            <div class="border-b px-4 py-3 flex justify-between">
                <h1 class="font-semibold">Exam Details</h1>
                <h1 class="">Class: {{ $studentReport->student->datastudent->classroom->name }}</h1>
            </div>
            <div class="flex justify-between px-4 py-3">

                <div class="grid grid-cols-2 flex-grow">
                    <span>Exam: {{ $exam->examType->name }}</span>
                    <span>Subject: {{ $exam->subject->name }}</span>
                    <span>Date: {{ $exam->date->format('l, d-m-Y') }}</span>
                    <span>Duration: {{ $exam->duration }} minutes</span>
                    <span>Start TIme:
                        {{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }}</span>
                    <span>Total Questions: {{ $exam->total_questions }}</span>
                </div>
                <div class="flex flex-col justify-start text-center px-10">
                    <span>Score</span>
                    <h1 class="text-4xl">{{$studentReport->score}}</h1>
                </div>
            </div>

        </div>
    </div>

    <div class="mx-4 lg:mx-0 mt-4 lg:mt-8 bg-white rounded-lg shadow-button">
        <div class="flex flex-col">
            <div class="border-b px-4 py-3">
                <h1 class="flex justify-between">Questionnaire: <span>{{ $studentReport->exam->title }}</span></h1>
            </div>
            <div class="py-4">
                @foreach ($exam->questions as $index => $question)
                    @php
                        $studentAnswer = $studentAnswers->where('question_id', $question->id)->first();
                        $selectedChoice = $studentAnswer ? $studentAnswer->selected_choices : [];
                        $correctChoice = $question->choices->where('is_correct', true)->pluck('id')->toArray();
                    @endphp
                    <div class="flex pb-6 border-b mx-8 mb-6">
                        <div class="w-10 mr-4 text-xl">{{ $index + 1 }}.</div>
                        <div class="flex flex-col w-full">
                            <p class="text-xs">Questions:</p>
                            <div class="w-full rounded-lg border-1 bg-white min-h-40 mb-4 mt-2">
                                {{ $question->question_text }}</div>
                            <div class="flex flex-col gap-y-2">
                                <div class="flex justify-between">
                                    <p class="text-xs">Multiple Choices:</p>
                                    <p class="text-xs">Answer Key:</p>
                                </div>
                                <div class="flex flex-col gap-y-1">
                                    @foreach ($question->choices as $choiceIndex => $choice)
                                        <div class="flex items-center">
                                            <span class=" w-4 lowercase">{{ chr(65 + $choiceIndex) }}.</span>
                                            <p class="rounded-lg h-max w-full px-2 items-center flex">
                                                {{ $choice->choice_text }}</p>
                                            <input type="radio" value="{{ $choice->id }}"
                                                class="w-8 h-8 flex "
                                                {{ in_array($choice->id, $selectedChoice) ? 'checked' : '' }}
                                                disabled>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <p class="text-xs mt-2">Answer:</p>
                            <div class="flex items-center py-2 mt-2 border {{ in_array($selectedChoice[0], $correctChoice) ? 'border-green-600' : 'border-red-600' }} rounded-xl px-3">
                                <span class="w-4 lowercase">
                                    {{ chr(65 + array_search($selectedChoice[0], $question->choices->pluck('id')->toArray())) }}.
                                </span>
                                <p class="rounded-lg h-max w-full px-2 items-center flex">
                                    {{ $question->choices->where('id', $selectedChoice[0])->first()->choice_text }}
                                </p>
                                <div class="flex gap-1 pr-3">
                                    <img src="{{ in_array($selectedChoice[0], $correctChoice) ? asset('icons/ic_correct2.svg') : asset('icons/ic_incorrect.svg') }}" alt="">
                                    <span>{{ in_array($selectedChoice[0], $correctChoice) ? 'Correct' : 'Incorrect' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
