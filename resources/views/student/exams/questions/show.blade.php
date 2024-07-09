{{-- @extends('layouts.test')

@section('content')
    <form method="POST" action="{{ route('students.exams.save-answer', ['exam' => $exam->id, 'question' => $exam->questions[$currentQuestionIndex]->question_number]) }}">
        @csrf

        <div class="flex flex-col gap-y-4 bg-white shadow-button rounded-lg p-3 lg:p-6">
            <div class="flex items-center gap-x-4">
                <div class="flex items-center justify-center rounded-full border border-accent-2 h-10 w-10">
                    <span class="font-semibold">{{ $currentQuestionIndex + 1 }}</span>
                </div>
                <span>Multiple Choices</span>
            </div>
            <div class="flex flex-col bg-slate-100 min-h-96 rounded-lg p-4 items-center overflow-hidden">
                <p class="whitespace-pre-line w-full lg:text-lg">{{ $exam->questions[$currentQuestionIndex]->question_text }}</p>
                @if ($exam->questions[$currentQuestionIndex]->image_path)
                    <img src="{{ Storage::url($exam->questions[$currentQuestionIndex]->image_path) }}"
                        class="max-h-96 max-w-fit my-4" alt="">
                @endif
            </div>

            <span class="text-gray-400 text-sm">Select your answer on the options below:</span>
            <div class="flex flex-col gap-4 pb-4">
                @foreach ($exam->questions[$currentQuestionIndex]->choices as $choiceIndex => $choice)
                    <div class="flex align-middle items-center">
                        <label class="choice-button">
                            <input type="checkbox" name="selected_choices[]" value="{{ $choice->id }}"
                                @if (in_array($choice->id, $studentAnswer->selected_choices ?? [])) checked @endif>
                            <span class="custom-checkbox"></span>
                            <span class="line-clamp-1">{{ chr(97 + $choiceIndex) }}.</span>
                            <span class="ml-3">{{ $choice->choice_text }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="flex flex-col gap-y-4 lg:gap-y-6 mx-4 lg:mx-0 mt-6">
            <div class="grid grid-cols-3 justify-between shadow-button">

                <button type="button" class="bg-white hover:bg-gray-100 rounded-l-xl lg:px-6 lg:py-4 py-2 px-2 flex-grow"
                    onclick="clearSelection()">Clear</button>

                <button type="button" class="bg-white hover:bg-gray-100 border-x-2 lg:px-6 lg:py-4 py-2 px-2 flex-grow">Mark</button>

                <button type="submit" class="bg-white hover:bg-gray-100 rounded-r-xl lg:px-6 lg:py-4 py-2 px-2 flex-grow">Save</button>
            </div>

            <div class="flex justify-start shadow-button gap-x-8">

                @if ($currentQuestionIndex > 0)
                    <a href="{{ route('students.exams.show-question', ['exam' => $exam->id, 'question' => $exam->questions[$currentQuestionIndex - 1]->question_number]) }}"
                        class="bg-white hover:bg-gray-100 text-center rounded-xl border lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center flex-grow">
                        <img src="{{ asset('icons/ic_left.svg') }}" alt="">Previous
                    </a>
                @endif

                @if ($currentQuestionIndex < count($exam->questions) - 1)
                    <a href="{{ route('students.exams.show-question', ['exam' => $exam->id, 'question' => $exam->questions[$currentQuestionIndex + 1]->question_number]) }}"
                        class="bg-white hover:bg-gray-100 text-center rounded-xl border lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center flex-grow">
                        Next<img src="{{ asset('icons/ic_right.svg') }}" alt="">
                    </a>
                @endif
            </div>

        </div>
    </form>
@endsection

@section('script')
    <script>
        function clearSelection() {
            document.querySelectorAll('input[name="selected_choices[]"]').forEach((checkbox) => {
                checkbox.checked = false;
            });
        }
    </script>
@endsection --}}
@extends('layouts.test')

@section('content')
    <form method="POST" action="{{ route('students.exams.save-answer', ['exam' => $exam->id, 'question' => $exam->questions[$currentQuestionIndex]->question_number]) }}">
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
                <p class="whitespace-pre-line w-full lg:text-lg">{{ $exam->questions[$currentQuestionIndex]->question_text }}</p>
                @if ($exam->questions[$currentQuestionIndex]->image_path)
                    <img src="{{ Storage::url($exam->questions[$currentQuestionIndex]->image_path) }}"
                        class="max-h-96 max-w-fit my-4" alt="">
                @endif
            </div>
            {{-- Exam choices --}}
            <span class="text-gray-400 text-sm">Select your answer on the options below:</span>
            <div class="flex flex-col gap-4 pb-4">
                @foreach ($exam->questions[$currentQuestionIndex]->choices as $choiceIndex => $choice)
                    <div class="flex align-middle items-center">
                        <label>
                            <input type="checkbox" name="selected_choices[]" value="{{ $choice->id }}"
                                @if (isset($studentAnswer) && in_array($choice->id, json_decode($studentAnswer->selected_choices ?? '[]'))) checked @endif>
                            <span class="ml-3">{{ chr(97 + $choiceIndex) }}. {{ $choice->choice_text }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Navigation buttons -->
        <div class="flex flex-col gap-y-4 lg:gap-y-6 mx-4 lg:mx-0 mt-6">
            <div class="grid grid-cols-3 justify-between shadow-button">
                {{-- Clear selection --}}
                <button type="button" class="bg-white hover:bg-gray-100 rounded-l-xl lg:px-6 lg:py-4 py-2 px-2 flex-grow"
                    onclick="clearSelection()">Clear</button>
                {{-- Mark the number = giving different color on navigation sidebar --}}
                <button type="button" class="bg-white hover:bg-gray-100 border-x-2 lg:px-6 lg:py-4 py-2 px-2 flex-grow">Mark</button>
                {{-- Save answer, still on the same page --}}
                <button type="submit" class="bg-white hover:bg-gray-100 rounded-r-xl lg:px-6 lg:py-4 py-2 px-2 flex-grow">Save</button>
            </div>

            <div class="flex justify-start shadow-button gap-x-8">
                {{-- Go back if there's any previous question --}}
                @if ($currentQuestionIndex > 0)
                    <a href="{{ route('students.exams.show-question', ['exam' => $exam->id, 'question' => $currentQuestionIndex - 1]) }}"
                        class="bg-white hover:bg-gray-100 text-center rounded-xl border lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center flex-grow">
                        <img src="{{ asset('icons/ic_left.svg') }}" alt="">Previous
                    </a>
                @endif
                {{-- Go to the next question --}}
                @if ($currentQuestionIndex < count($exam->questions) - 1)
                    <a href="{{ route('students.exams.show-question', ['exam' => $exam->id, 'question' => $currentQuestionIndex + 1]) }}"
                        class="bg-white hover:bg-gray-100 text-center rounded-xl border lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center flex-grow">
                        Save & Next<img src="{{ asset('icons/ic_right.svg') }}" alt="">
                    </a>
                @endif
            </div>

            {{-- Submit all answers (commented out for now) --}}
            {{-- <a href="{{ route('students.exams.finish', ['exam' => $exam->id]) }}"
                class="bg-orange-400 text-white font-semibold hover:bg-orange-300 text-center rounded-xl lg:px-6 lg:py-4 py-2 px-2 shadow-button flex justify-center items-center flex-grow">
                Finish & Submit
            </a> --}}
        </div>
    </form>
@endsection

@section('script')
    <script>
        function clearSelection() {
            document.querySelectorAll('input[name="selected_choices[]"]').forEach((checkbox) => {
                checkbox.checked = false;
            });
        }
    </script>
@endsection
