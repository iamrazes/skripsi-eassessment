@extends('layouts.app')

@section('content')
    <div class="mx-4 lg:mx-0 lg:mt-8 bg-white rounded-lg shadow-button">
        <div class="flex flex-col">
            <div class="border-b px-4 py-3 flex justify-between">
                <h1 class="font-semibold">Answer: {{ $studentReport->student->name }}</h1>
                <h1 class="">Class: {{ $studentReport->student->datastudent->classroom->name }}</h1>
            </div>
        </div>
    </div>

    <div class="mx-4 lg:mx-0 lg:mt-8 bg-white rounded-lg shadow-button">
        <div class="flex flex-col">
            <div class="border-b px-4 py-3">
                <h1 class="font-semibold">Questionnaire: {{ $studentReport->exam->title }}</h1>
            </div>
            <div class="py-4">
                @foreach ($exam->questions as $index => $question)
                    <div class="flex pb-6 border-b mx-8 mb-6">
                        <div class="w-10 mr-4 text-xl">{{ $index + 1 }}.</div>
                        <div class="flex flex-col w-full">
                            <p class="text-xs">Questions:</p>
                            <div class="w-full rounded-lg border-1 bg-white min-h-40 mb-4 mt-2">
                                {{ $question->question_text }}</div>
                            <div class="flex flex-col gap-y-2">
                                <div class="flex justify-between">
                                    <p class="text-xs">Multiple Choices:</p>
                                    <p class="text-xs">Correct Choices:</p>
                                </div>
                                <div class="flex flex-col gap-y-1">
                                    @foreach ($question->choices as $choiceIndex => $choice)
                                        <div class="flex items-center">
                                            <span class=" w-4 lowercase">{{ chr(65 + $choiceIndex) }}.</span>
                                            <p class="rounded-lg h-max w-full px-2 items-center flex">
                                                {{ $choice->choice_text }}</p>
                                            <input type="radio" value="{{ $choice->id }}"
                                                class="h-8 min-w-8 flex "
                                                {{ in_array($choice->id, $studentAnswers->where('question_id', $question->id)->first()->selected_choices) ? 'checked' : '' }}
                                                disabled>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <p class="text-xs mt-2">Answer:</p>
                            @if (in_array($question->correct_choice_id, $studentAnswers->where('question_id', $question->id)->first()->selected_choices))
                                <div class="flex items-center py-2 mt-2 border border-green-600 rounded-xl px-3">
                                    <span class="w-4 lowercase">{{ chr(65 + $choiceIndex) }}.</span>
                                    <p class="rounded-lg h-max w-full px-2 items-center flex">
                                        {{ $question->choices->where('id', $question->correct_choice_id)->first()->choice_text }}
                                    </p>
                                    <div class="flex gap-1 pr-3">
                                        <img src="{{ asset('icons/ic_correct2.svg') }}" alt="">
                                        <span>Correct</span>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center py-2 mt-2 border border-red-600 rounded-xl px-3">
                                    <span class="w-4 lowercase">{{ chr(65 + $choiceIndex) }}.</span>
                                    <p class="rounded-lg h-max w-full px-2 items-center flex">
                                        {{ $studentAnswers->where('question_id', $question->id)->first()->selected_choices_text }}
                                    </p>
                                    <div class="flex gap-1 pr-3">
                                        <img src="{{ asset('icons/ic_incorrect.svg') }}" alt="">
                                        <span>Incorrect</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
