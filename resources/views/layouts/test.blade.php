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
    <x-exams.header :exam="$exam" />

    <!-- Main content section -->
    <div class="flex flex-col lg:flex-row gap-x-8 -mt-14 lg:px-16 mb-8">
        <div class="flex flex-col gap-y-4 lg:gap-y-8 flex-grow">
            @yield('content')
        </div>

        <!-- Sidebar navigation -->
        <x-exams.sidebar :exam="$exam" :data-student="$dataStudent" :current-question-index="$currentQuestionIndex" />


    </div>

    @yield('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectedChoices = @json($studentAnswer->selected_choices ?? []);

            // Loop through each checkbox and set its checked state
            document.querySelectorAll('.choice-button input[type="checkbox"]').forEach(checkbox => {
                var choiceId = parseInt(checkbox.value); // Assuming checkbox value is numeric ID

                if (selectedChoices.includes(choiceId)) {
                    checkbox.checked = true;
                    checkbox.nextElementSibling.style.backgroundColor = '#000'; // Apply selected style
                }

                checkbox.addEventListener('click', function() {
                    if (this.checked) {
                        document.querySelectorAll('.choice-button input[type="checkbox"]').forEach(
                            otherCheckbox => {
                                if (otherCheckbox !== this) {
                                    otherCheckbox.checked = false;
                                    otherCheckbox.nextElementSibling.style.backgroundColor = '';
                                }
                            });
                        this.nextElementSibling.style.backgroundColor = '#000';
                    } else {
                        this.nextElementSibling.style.backgroundColor = '';
                    }
                });
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
