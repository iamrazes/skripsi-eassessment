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
