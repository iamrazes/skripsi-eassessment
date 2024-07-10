<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $exam->title }} - {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('icons/logo.svg') }}">
</head>

<body class="bg-[#F5F7F8] text-textColor antialiased flex flex-col">
    <div class="container justify-center items-center mx-auto mt-8 lg:mt-20">
        <div class="bg-white rounded-3xl border-2 border-accent-1 shadow-button mx-4 my-4 p-4 pt-10 pb-20">
            <div class="justify-center flex filter-red">
                <img src="{{ asset('icons/ic_alert.svg') }}" class="lg:w-40 lg:h-40 w-20 h-20">
            </div>
            <div class="items-center flex flex-col text-center overflow-hidden">
                <h1 class="lg:text-4xl text-xl filter-red">Attentions!</h1>
                <p class="mt-2 text-sm lg:text-base">You are going to attend exam "<strong>{{ $exam->title }}</strong>"
                </p>
                <p class="text-xs sm:text-sm lg:text-base lg:w-1/2 whitespace-wrap my-2">
                    Before you start your exam, please make sure you have read all instructions carefully. Ensure you
                    have a stable internet connection and a quiet environment to focus. This exam is timed, and once you
                    begin, the timer cannot be paused. Make sure to save your answers periodically. If you encounter any
                    issues during the exam, contact your instructor immediately. Good luck!
                </p>

            </div>
            <div
                class="flex flex-col bg-gray-100 mx-auto max-w-full px-3 py-2 lg:px-3 rounded-xl mt-3 text-sm lg:text-base lg:w-1/2">
                <p class="flex justify-between"><span>Subject:</span> {{ $exam->subject->name }}</p>
                <p class="flex justify-between"><span>Type:</span> {{ $exam->examType->name }}</p>
                <p class="flex justify-between"><span>Date:</span> {{ $exam->date->format('F, d-m-Y') }}</p>
                <p class="flex justify-between"><span>Start:</span> <span
                        class="text-end">{{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }}
                    </span></p>
                <p class="flex justify-between"><span>Duration:</span> {{ $exam->duration }} minutes</p>
            </div>
            <div class="text-center mt-3 flex flex-col lg:w-1/2 lg:mx-auto">
                @if ($isExamAvailable)
                    <a href="{{ route('students.exams.show-question', ['exam' => $exam->id, 'question' => 1]) }}"
                        class="bg-accent-1 hover:bg-gradient-to-r from-accent-1 to-accent-2 py-2 my-2 text-white font-semibold rounded-3xl">
                        Start the Exam
                    </a>
                    <p class="text-sm lg:text-base">*The exam is available, click the button to continue</p>
                @else
                    <a class="bg-gray-100 py-2 my-2 text-gray-400 rounded-3xl">Unavailable</a>
                    <p class="text-sm lg:text-base">*The link will be available when the time is down</p>
                @endif
            </div>
        </div>
        <div class="flex mx-4 ">
            <a href="{{ route('students.exams.index') }}" class="text-accent-1 hover:text-accent-2 flex gapx-2"><img
                    src="{{ asset('icons/ic_left2.svg') }}" alt="">Go Back</a>
        </div>
    </div>
</body>

</html>
