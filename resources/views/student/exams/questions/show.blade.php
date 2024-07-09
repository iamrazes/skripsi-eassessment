@extends('layouts.test')

@section('content')
    <form method="POST"
          action="{{ route('students.exams.save-answer', ['exam' => $exam->id, 'question' => $exam->questions[$currentQuestionIndex]->question_number]) }}">
        @csrf

        <!-- Display current question -->
        <div class="flex flex-col gap-y-4 bg-white shadow-button rounded-lg p-3 lg:p-6">
            <div class="flex items-center gap-x-4">
                <div class="flex items-center justify-center rounded-full border border-accent-2 h-10 w-10">
                    <span class="font-semibold">{{ $currentQuestionIndex + 1 }}</span>
                </div>
                <span>Multiple Choices</span>
            </div>
            <div class="flex flex-col bg-slate-100 min-h-96 rounded-lg p-4 items-center overflow-hidden">
                <p class="whitespace-pre-line w-full lg:text-lg">{{ $question->question_text }}</p>
                @if ($question->image_path)
                    <img src="{{ Storage::url($question->image_path) }}" class="max-h-96 max-w-fit my-4" alt="">
                @endif
            </div>

            <!-- Display answer choices -->
            <span class="text-gray-400 text-sm">Select your answer on the options below:</span>
            <div class="flex flex-col gap-4 pb-4">
                @foreach ($question->choices as $choiceIndex => $choice)
                    <div class="flex align-middle items-center">
                        <label class="choice-button">
                            <input type="checkbox" name="selected_choices[]" value="{{ $choice->id }}"
                                   @if (in_array($choice->id, $selectedChoices)) checked @endif>
                            <span class="custom-checkbox"></span>
                            <span class="line-clamp-1">{{ chr(97 + $choiceIndex) }}.</span>
                            <span class="ml-3">{{ $choice->choice_text }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Save button -->
        <div class="flex justify-end mt-6">
            <button type="submit"
                    class="bg-white hover:bg-gray-100 rounded-xl lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center shadow-button border">
                Save
            </button>
        </div>
    </form>
@endsection
