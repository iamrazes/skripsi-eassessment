@extends('layouts.app')

@section('content')
    <div class="mx-4 lg:mx-0 lg:mt-8 bg-white rounded-lg shadow-button">
        <div class="flex flex-col">
            <div class="border-b px-4 py-3 flex justify-between">
                <h1 class="font-semibold">Answer: {{ $studentReport->student->name }}</h1>
                <h1 class="">Class: {{ $studentReport->student->datastudent->classroom->name }}</h1>
            </div>
            <div class="grid grid-cols-2 px-4 py-3">
                <span>Name: {{ $studentReport->student->name }}</span>
                <span>Student ID: {{ $studentReport->student->datastudent->student_id }}</span>
                <span>Classroom: {{ $studentReport->student->datastudent->classroom->name }}</span>
                <span>Email: {{ $studentReport->student->email }}</span>
                <span>Gender: <span class="capitalize">{{ $studentReport->student->datastudent->gender }}</span></span>
                <span>Score: {{ $studentReport->score }}</span>
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
                        $correctChoices = $question->choices->where('is_correct', true)->pluck('id')->toArray();
                    @endphp
                    <div class="flex pb-6 border-b mx-8 mb-6">
                        <div class="w-10 mr-4 text-xl">{{ $index + 1 }}.</div>
                        <div class="flex flex-col w-full">
                            <p class="text-xs">Questions:</p>
                            <div class="w-full rounded-lg border-1 bg-white min-h-40 mb-4 mt-2">
                                {{ $question->question_text }}</div>

                            @if ($question->image_path)
                                <img src="{{ Storage::url($question->image_path) }}" class="max-h-96 max-w-fit my-4"
                                    alt="">
                            @endif
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
                                            <input type="radio" value="{{ $choice->id }}" class="w-8 h-8 flex "
                                                {{ in_array($choice->id, $correctChoices) ? 'checked' : '' }} disabled>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <p class="text-xs mt-2">Answer:</p>
                            <div
                                class="flex items-center py-2 mt-2 border
                                @if (empty($selectedChoice)) border-red-600
                                @elseif (count(array_intersect($selectedChoice, $correctChoices)) === count($correctChoices))
                                    border-green-600
                                @else
                                    border-red-600 @endif
                                rounded-xl px-3">
                                @if (empty($selectedChoice))
                                    <span class="w-4 lowercase">-</span>
                                    <p class="rounded-lg h-max w-full px-2 items-center flex">Not Answered</p>
                                @else
                                    <span class="w-4 lowercase">
                                        {{ chr(65 + array_search($selectedChoice[0], $question->choices->pluck('id')->toArray())) }}.
                                    </span>
                                    <p class="rounded-lg h-max w-full px-2 items-center flex">
                                        {{ $question->choices->where('id', $selectedChoice[0])->first()->choice_text }}
                                    </p>
                                    <div class="flex gap-1 pr-3">
                                        <img src="{{ count(array_intersect($selectedChoice, $correctChoices)) === count($correctChoices) ? asset('icons/ic_correct2.svg') : asset('icons/ic_incorrect.svg') }}"
                                            alt="">
                                        <span>{{ count(array_intersect($selectedChoice, $correctChoices)) === count($correctChoices) ? 'Correct' : 'Incorrect' }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
