<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $exam->title }} - {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('icons/logo.svg') }}">
    <style>
        /* Hide the default checkbox */
        input[type="checkbox"] {
            display: none;
        }

        /* Style the label as a button */
        .choice-button {
            display: flex;
            align-items: center;
            cursor: pointer;
            flex-shrink: 0;
            /* Prevent shrinking */
        }

        /* Style the custom checkbox */
        .custom-checkbox {
            width: 20px;
            /* Adjust the width as needed */
            height: 20px;
            /* Adjust the height as needed */
            border-radius: 50%;
            /* Make it circular */
            border: 1px solid #000;
            /* Add a border */
            margin-right: 10px;
            /* Add margin between the checkbox and text */
            flex-shrink: 0;
            /* Prevent shrinking */
        }

        /* Style the checkbox label */
        .choice-button span {
            vertical-align: middle;
            /* Align text vertically */
            flex-shrink: 0;
            /* Prevent shrinking */
        }

        /* Style the custom checkbox when checked */
        input[type="checkbox"]:checked+.custom-checkbox {
            background-color: #000;
            /* Change background color when checked */
        }
    </style>
</head>

<body class="bg-[#F5F7F8] text-textColor antialiased flex flex-col">

    <!-- Header section -->
    <div
        class="flex justify-between bg-gradient-to-r from-accent-1 to-accent-2 lg:pt-8 pb-20 pt-5 px-3 lg:px-16 flex-grow text-white">
        <div>
            <h1 class="font-bold lg:text-2xl uppercase">{{ $exam->examType->name }}</h1>
            <h2 class="font-semibold">Subject: {{ $exam->subject->name }}</h2>
            <h2 class="font-semibold">Date: {{ $exam->date->format('F, d-m-Y') }}</h2>
        </div>
        <div class="flex flex-col text-end">
            <span class="flex items-center place-content-end gap-x-2">
                <span id="countdown" class="lg:text-4xl text-2xl gap-x-2">00:00:00</span>
                <img src="{{ asset('icons/ic_timer.svg') }}" alt="" class="h-8 lg:h-12">
            </span>
            <h2 class="font-semibold">Duration: {{ $exam->duration }} minutes</h2>
            <h2 class="font-semibold">Schedule: {{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }} - Done
            </h2>
        </div>
    </div>

    <!-- Main content section -->
    <div class="flex flex-col lg:flex-row gap-x-8 -mt-14 lg:px-16 mb-8">
        <div class="flex flex-col gap-y-4 lg:gap-y-8 flex-grow">
            <!-- Exam questions -->
            @foreach ($exam->questions as $index => $question)
                <div class="flex flex-col gap-y-4 bg-white shadow-button rounded-lg p-3 lg:p-6">
                    <div class="flex items-center gap-x-4">
                        <div class="flex items-center justify-center rounded-full border border-accent-2 h-10 w-10">
                            <span class="font-semibold">{{ $index + 1 }}</span>
                        </div>
                        <span>Multiple Choices</span>
                    </div>
                    <div class="flex flex-col bg-slate-100 min-h-96 rounded-lg p-4 items-center overflow-hidden">
                        <p class="whitespace-pre-line w-full lg:text-lg">{{ $question->question_text }}</p>
                        @if ($question->image_path)
                            <img src="{{ Storage::url($question->image_path) }}" class="max-h-72 max-w-fit my-4"
                                alt="">
                        @endif
                    </div>
                    {{-- Exam choices --}}
                    <span class="text-gray-400 text-sm">Select your answer on the options below:</span>
                    <div class="flex flex-col gap-4 pb-4">
                        @foreach ($question->choices as $choiceIndex => $choice)
                            <div class="flex align-middle items-center">
                                <label class="choice-button">
                                    <input type="checkbox" name="answers[{{ $question->id }}]"
                                        value="{{ $choice->id }}">
                                    <span class="custom-checkbox"></span>
                                    <span class="line-clamp-1">{{ chr(97 + $choiceIndex) }}.</span>
                                </label>
                                <span class="ml-3">{{ $choice->choice_text }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <!-- Navigation buttons -->
            <div class="flex flex-col gap-y-4 lg:gap-y-8 mx-4 lg:mx-0">
                <div class="grid grid-cols-3 justify-between shadow-button">
                    <button
                        class="bg-white hover:bg-gray-100 rounded-l-xl lg:px-6 lg:py-4 py-2 px-2 flex-grow">Clear</button>
                    <button
                        class="bg-white hover:bg-gray-100 border-x-2 lg:px-6 lg:py-4 py-2 px-2 flex-grow">Mark</button>
                    <button
                        class="bg-white hover:bg-gray-100 rounded-r-xl lg:px-6 lg:py-4 py-2 px-2 flex-grow">Save</button>
                </div>
                <div class="flex justify-start shadow-button">
                    <a
                        class="bg-white hover:bg-gray-100 text-center rounded-l-xl lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center flex-grow"><img
                            src="{{ asset('icons/ic_left.svg') }}" alt="">Previous</a>
                    <a
                        class="bg-white hover:bg-gray-100 text-center rounded-r-xl border-l-2 lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center flex-grow">Save
                        & Next<img src="{{ asset('icons/ic_right.svg') }}" alt=""></a>
                </div>
            </div>
        </div>

        <!-- Sidebar navigation -->
        <div
            class="flex flex-col bg-white shadow-button rounded-lg min-h-screen flex-grow lg:max-w-[400px] mt-8 lg:mt-0 shrink-0">
            <div class="border-b">
                <div class="flex py-6 px-8 gap-x-4">
                    <img src="{{ asset($dataStudent->gender == 'Male' ? 'images/img_dashboard_maleStudent.png' : 'images/img_dashboard_femaleStudent.png') }}"
                        class="lg:w-20 lg:h-20 w-32 h-32" alt="">
                    <div class="flex flex-col py-2 overflow-x-hidden flex-grow">
                        <span class="font-semibold lg:max-w-52 uppercase">{{ auth()->user()->name }}</span>
                        <span>{{ $dataStudent->student_id }}</span>
                        <span>{{ $dataStudent->classroom->name ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-5 justify-items-center p-4 lg:py-4 lg:px-4 gap-4 lg:gap-4">
                @foreach ($exam->questions as $index => $question)
                    <button
                        class="question-nav shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border hover:bg-gray-100"
                        >{{ $index + 1 }}</button>
                @endforeach
            </div>
            <div class="flex-grow"></div>
            <div class="flex flex-col gap-y-2 place-content-end border-t py-4 align-middle">
                <span class="flex gap-x-2 px-4">
                    <div class="w-5 h-5 rounded-md bg-white border shadow"></div>Not Answered
                </span>
                <span class="flex gap-x-2 px-4">
                    <div class="w-5 h-5 rounded-md bg-accent-1 shadow"></div>Answered
                </span>
                <span class="flex gap-x-2 px-4">
                    <div class="w-5 h-5 rounded-md bg-white border-accent-1 border-2 shadow"></div>Currently Seeing
                </span>
                <span class="flex gap-x-2 px-4">
                    <div class="w-5 h-5 rounded-md bg-yellow-400 shadow"></div>Marked (Not Answered)
                </span>
                <span class="flex gap-x-2 px-4">
                    <div class="w-5 h-5 rounded-md bg-cyan-300 shadow"></div>Marked (Answered)
                </span>
            </div>
        </div>
    </div>

    <!-- JavaScript scripts -->
    <script>
        // JavaScript to handle checkbox selection
        document.querySelectorAll('.choice-button input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('click', function() {
                if (this.checked) {
                    document.querySelectorAll('.choice-button input[type="checkbox"]').forEach(
                        otherCheckbox => {
                            if (otherCheckbox !== this) {
                                otherCheckbox.checked = false;
                                otherCheckbox.nextElementSibling.style.backgroundColor =
                                    '';
                            }
                        });
                    this.nextElementSibling.style.backgroundColor = '#000';
                } else {
                    this.nextElementSibling.style.backgroundColor = '';
                }
            });
        });
    </script>
    <script>
        // JavaScript for countdown timer
        function formatDuration(durationInMinutes) {
            var hours = Math.floor(durationInMinutes / 60);
            var minutes = durationInMinutes % 60;
            var seconds = 0;

            return `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
        }

        function pad(num) {
            return (num < 10 ? '0' : '') + num;
        }

        function startTimer(durationSeconds, display) {
            var timer = durationSeconds,
                hours, minutes, seconds;
            setInterval(function() {
                hours = parseInt(timer / 3600, 10);
                minutes = parseInt((timer % 3600) / 60, 10);
                seconds = timer % 60;

                hours = pad(hours);
                minutes = pad(minutes);
                seconds = pad(seconds);

                display.textContent = `${hours}:${minutes}:${seconds}`;

                if (--timer < 0) {
                    timer = durationSeconds;
                }
            }, 1000);
        }

        var startTime = new Date("{{ $exam->date->format('Y-m-d') }} {{ $exam->start_time }}").getTime();
        var durationMinutes = {{ $exam->duration }};
        var durationSeconds = durationMinutes * 60;
        var now = new Date().getTime();
        var remainingTime = durationSeconds - Math.floor((now - startTime) / 1000);

        document.addEventListener('DOMContentLoaded', function() {
            var display = document.querySelector('#countdown');
            startTimer(remainingTime, display);
        });
    </script>
</body>

</html>
