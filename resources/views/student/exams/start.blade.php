@extends('layouts.test')

@section('head')
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
        flex-shrink: 0; /* Prevent shrinking */
    }

    /* Style the custom checkbox */
    .custom-checkbox {
        width: 20px; /* Adjust the width as needed */
        height: 20px; /* Adjust the height as needed */
        border-radius: 50%; /* Make it circular */
        border: 1px solid #000; /* Add a border */
        margin-right: 10px; /* Add margin between the checkbox and text */
        flex-shrink: 0; /* Prevent shrinking */
    }

    /* Style the checkbox label */
    .choice-button span {
        vertical-align: middle; /* Align text vertically */
        flex-shrink: 0; /* Prevent shrinking */
    }

    /* Style the custom checkbox when checked */
    input[type="checkbox"]:checked + .custom-checkbox {
        background-color: #000; /* Change background color when checked */
    }
</style>
@endsection

@section('content')
    <nav
        class="flex justify-between bg-gradient-to-r from-accent-1 to-accent-2 lg:pt-8 pb-20 pt-5 px-3 lg:px-16 flex-grow text-white">
        <div>
            <h1 class="font-bold lg:text-2xl uppercase">ULANGAN TENGAH SEMESTER</h1>
            <h2>Subject: {{$exam->subject->name}}</h2>
            <h3>Duration: {{$exam->duration}} minutes</h3>
        </div>
        <div class="flex flex-col text-end">
            <span class="flex items-center place-content-end gap-x-2">
                {{-- timer --}}
                <span class="lg:text-4xl text-2xl gap-x-2">44:22</span>
                <img src="{{asset('icons/ic_timer.svg')}}" alt="" class="h-8 lg:h-12">
            </span>
        </div>
    </nav>

    <main class="flex flex-col lg:flex-row gap-x-8 -mt-14 lg:px-16 mb-8 ">
        {{-- main content / questions --}}
        <div class="flex flex-col gap-y-4 lg:gap-y-8 flex-grow">
            <div class="flex flex-col gap-y-4 bg-white shadow-button rounded-lg p-3 lg:p-6">
                <div class="flex items-center gap-x-4">
                    <div class="flex items-center justify-center rounded-full border border-accent-2 h-10 w-10">
                        <span class="font-semibold">1</span>
                    </div>
                    <span>Multiple Choices</span>
                </div>
                <div class="flex flex-col bg-slate-100 min-h-96 rounded-lg p-4 items-center overflow-hidden">

                    <!-- question--->
                    <p class="whitespace-pre-line w-full lg:text-lg ">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non enim in lorem facilisis finibus ut in nisl. Nulla facilisi. Phasellus placerat justo ac feugiat congue. Donec in laoreet dolor, vel pulvinar nulla. Morbi vel lectus eros. Nunc consequat interdum odio, sit amet laoreet velit condimentum ac. Fusce sodales mi in dui ultrices lobortis. Nulla in varius leo, non commodo quam. Vivamus et tristique est. Aenean

                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non enim in lorem facilisis finibus ut in nisl. Nulla facilisi. Phasellus placerat justo ac feugiat congue. Donec in laoreet dolor, vel pulvinar nulla. Morbi vel lectus eros. Nunc consequat interdum odio, sit amet laoreet velit condimentum ac. Fusce sodales mi inLorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non enim in lorem facilisis finibus ut in nisl. Nulla facilisi. Phasellus placerat justo ac feugiat congue. Donec in laoreet dolor, vel pulvinar nulla. Morbi vel lectus eros. Nunc consequat interdum odio, sit amet laoreet velit condimentum ac. Fusce sodales mi in.
                    </p>
                    <!-- if theres image available show this --->
                    <img src="/public/images/images.jpg" class="max-h-72 max-w-fit my-4 " alt="">
                </div>
                <span class="text-gray-400 text-sm">Select your answer on the options below:</span>
                <div class="flex flex-col gap-4 pb-4">
                    {{-- up to 5 choices, alphabetick a-e --}}
                    <div class="flex align-middle items-center">
                        <label class="choice-button">
                            <input type="checkbox" value="1">
                            <span class="custom-checkbox"></span>
                            <span class="line-clamp-1">a.</span>
                        </label>
                        <span class="ml-3">Lorem ipsum dolor sit amet, consectetur asdasdas adipiscing elit.</span>
                    </div>
                    <div class="flex align-middle items-center">
                        <label class="choice-button">
                            <input type="checkbox" value="1">
                            <span class="custom-checkbox"></span>
                            <span class="line-clamp-1">a.</span>
                        </label>
                        <span class="ml-3">Lorem ipsum dolor sit amet, consectetur asdasdas adipiscing elit.</span>
                    </div>
                    <div class="flex align-middle items-center">
                        <label class="choice-button">
                            <input type="checkbox" value="1">
                            <span class="custom-checkbox"></span>
                            <span class="line-clamp-1">a.</span>
                        </label>
                        <span class="ml-3">Lorem ipsum dolor sit amet, consectetur asdasdas adipiscing elit.</span>
                    </div>
                    <div class="flex align-middle items-center">
                        <label class="choice-button">
                            <input type="checkbox" value="1">
                            <span class="custom-checkbox"></span>
                            <span class="line-clamp-1">a.</span>
                        </label>
                        <span class="ml-3">Lorem ipsum dolor sit amet, consectetur asdasdas adipiscing elit.</span>
                    </div>
                    <div class="flex align-middle items-center">
                        <label class="choice-button">
                            <input type="checkbox" value="1">
                            <span class="custom-checkbox"></span>
                            <span class="line-clamp-1">a.</span>
                        </label>
                        <span class="ml-3">Lorem ipsum dolor sit amet, consectetur asdasdas adipiscing elit.</span>
                    </div>
                </div>

            </div>
            <div class="flex flex-col gap-y-4 lg:gap-y-8 mx-4 lg:mx-0">
                <div class="grid grid-cols-3 justify-between shadow-button">
                    <button class="bg-white hover:bg-gray-100 rounded-l-xl lg:px-6 lg:py-4 py-2 px-2 flex-grow">Clear</button>
                    <button class="bg-white hover:bg-gray-100 border-x-2 lg:px-6 lg:py-4 py-2 px-2 flex-grow">Mark</button>
                    <button class="bg-white hover:bg-gray-100 rounded-r-xl lg:px-6 lg:py-4 py-2 px-2 flex-grow">Save</button>
                </div>
                <div class="flex justify-start shadow-button">
                    <a href="/src/assessment.html"
                        class="bg-white hover:bg-gray-100 text-center rounded-l-xl lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center flex-grow"><img src="{{asset('icons/ic_left.svg')}}" alt="">Previous</a>
                    <a href="/src/cbt-2.html" class="bg-white hover:bg-gray-100 text-center rounded-r-xl border-l-2 lg:px-6 lg:py-4 py-2 px-2 flex justify-center items-center flex-grow">Save & Next<img src="{{asset('icons/ic_right.svg')}}" alt=""></a>
                </div>
            </div>
        </div>
        {{-- sidebar navigation --}}
        <div class="flex flex-col bg-white shadow-button rounded-lg min-h-screen flex-grow lg:max-w-[400px] mt-8 lg:mt-0 shrink-0 ">
            {{-- user details --}}
            <div class="border-b">
                <div class="flex py-6 px-8 gap-x-4">

                    <img src="{{ asset($dataStudent->gender == 'Male' ? 'images/img_dashboard_maleStudent.png' : 'images/img_dashboard_femaleStudent.png') }}" class="lg:w-20 lg:h-20 w-32 h-32" alt="">
                    <div class="flex flex-col py-2 overflow-x-hidden flex-grow">
                        <span class="font-semibold lg:max-w-52 uppercase">{{ auth()->user()->name }} as asasas ASDS ADSAD ASDAD ASDSADA SDASDASD </span>
                        <span>{{ $dataStudent->student_id }}</span>
                        <span>{{ $dataStudent->classroom->name ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
            {{-- number navigation --}}
            <div class="grid grid-cols-5 justify-items-center p-4 lg:py-4 lg:px-4 gap-4 lg:gap-4">
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl text-white bg-accent-1">1</button> <!-- Answered -->
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border-4 border-accent-1">2</button> <!-- Selected -->
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl text-white bg-orange-300">3</button> <!-- Mark Not Answered -->
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl text-white bg-accent-2">4</button> <!-- Mark Answered -->
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">5</button> <!-- Unanswered -->
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">6</button>
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">7</button>
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">8</button>
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">9</button>
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">10</button>
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">11</button>
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">12</button>
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">13</button>
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">14</button>
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">15</button>
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">16</button>
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">17</button>
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">18</button>
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">19</button>
                <button class="shadow-md rounded-xl lg:w-12 lg:h-12 w-full h-16 font-semibold text-2xl lg:text-xl border">20</button>
            </div>
            <div class="flex-grow">
            </div>
            {{-- legend for indications on the navigations button number --}}
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
                    <div class="w-5 h-5 rounded-md bg-orange-300 shadow"></div>Marked (Not Answered)
                </span>
                <span class="flex gap-x-2 px-4">
                    <div class="w-5 h-5 rounded-md bg-accent-2 shadow"></div>Marked (Answered)
                </span>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        // Set the duration in minutes
        var duration = 60; // example duration, change as needed
        var timer = duration * 60; // Convert to seconds

        // Update the timer every second
        var countdownInterval = setInterval(function() {
            var minutes = Math.floor(timer / 60);
            var seconds = timer % 60;

            // Display the timer
            document.getElementById('timer').textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

            // Check if the timer has run out
            if (timer <= 0) {
                clearInterval(countdownInterval);
                showTimeoutModal();
            }

            timer--;
        }, 1000);

        // Function to show the timeout modal
        function showTimeoutModal() {
            document.getElementById('timeoutModal').classList.remove('hidden');
        }

        // Function to handle modal confirmation
        function handleModalConfirmation() {
            // Save progress and exit the exam
            // Implement the logic to save progress and redirect the user
            // For example:
            alert('Time is up! Saving your progress...');
            window.location.href = '/path/to/save-and-exit'; // Change to the actual save and exit route
        }
    </script>
    <script>
        // JavaScript to allow only one checkbox to be selected at a time
        document.querySelectorAll('.choice-button input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('click', function() {
                if (this.checked) {
                    document.querySelectorAll('.choice-button input[type="checkbox"]').forEach(
                        otherCheckbox => {
                            if (otherCheckbox !== this) {
                                otherCheckbox.checked = false;
                                otherCheckbox.nextElementSibling.style.backgroundColor =
                                    ''; // Reset other checkboxes' styles
                            }
                        });
                    this.nextElementSibling.style.backgroundColor = '#000'; // Style the selected checkbox
                } else {
                    this.nextElementSibling.style.backgroundColor = ''; // Reset the style if unchecked
                }
            });
        });
    </script>
@endsection
