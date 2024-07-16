@extends('layouts.test')

@section('content')
    <div id="notification" class="notification">
        {{ session('success') }}
    </div>

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
            <div class="flex flex-col bg-slate-100 min-h-80 rounded-lg p-4 items-center overflow-hidden">
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

        <input type="hidden" name="current_question" value="{{ $currentQuestionIndex }}">
        <input type="hidden" name="action" id="action" value="save">
        <input type="hidden" name="scroll_position" id="scroll_position" value="">

        <div class="flex mt-6 gap-x-4">
            @if ($currentQuestionIndex > 0)
                <a href="{{ route('students.exams.show-question', ['exam' => $exam->id, 'question' => $exam->questions[$currentQuestionIndex - 1]->question_number]) }}"
                    class="bg-white hover:bg-gray-100 w-full rounded-xl lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center shadow-button border">
                    Previous
                </a>
            @endif

            <button type="submit"
                class="bg-white hover:bg-gray-100 w-full rounded-xl lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center shadow-button border">
                Save
            </button>

            @if ($currentQuestionIndex < count($exam->questions) - 1)
                <button type="submit" onclick="document.getElementById('action').value='save_next'"
                    class="bg-white hover:bg-gray-100 w-full rounded-xl lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center shadow-button border">
                    Save & Next
                </button>
            @endif

            @if ($currentQuestionIndex < count($exam->questions) - 1)
                <a href="{{ route('students.exams.show-question', ['exam' => $exam->id, 'question' => $exam->questions[$currentQuestionIndex + 1]->question_number]) }}"
                    class="bg-white hover:bg-gray-100 w-full rounded-xl lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center shadow-button border">
                    Next
                </a>
            @endif
        </div>
    </form>

    <!-- Finish button -->
    @php
        $allQuestionsAnswered = $exam->questions->every(function ($question) use ($exam, $studentId) {
            return \App\Models\ExamStudentAnswer::isQuestionAnswered($exam->id, $studentId, $question->id);
        });
    @endphp

    @if ($allQuestionsAnswered)
        <form method="POST" action="{{ route('students.exams.finish', ['exam' => $exam->id]) }}">
            @csrfgi
            <div class="flex mt-4">
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white rounded-xl lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center shadow-button w-full">
                    Finish Exam
                </button>
            </div>
        </form>
    @endif
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show notification if success message is present
            @if (session('success'))
                const notification = document.getElementById('notification');
                notification.style.display = 'block';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 3000);
            @endif

            // Keep the scroll position after form submission
            if (window.history.scrollRestoration) {
                window.history.scrollRestoration = 'manual';
            }
            window.scrollTo(0, {{ session('scroll_position', '0') }});

            // Save scroll position on form submit
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', () => {
                    const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
                    localStorage.setItem('scrollPosition', scrollPosition);
                });
            });

            const savedPosition = localStorage.getItem('scrollPosition');
            if (savedPosition) {
                window.scrollTo(0, parseInt(savedPosition));
                localStorage.removeItem('scrollPosition');
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            form.addEventListener('submit', () => {
                const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
                document.getElementById('scroll_position').value = scrollPosition;
            });
        });
    </script>
@endsection
