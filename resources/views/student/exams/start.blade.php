@extends('layouts.cbt')

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
        }

        /* Style the checkbox label */
        .choice-button span {
            vertical-align: middle;
            /* Align text vertically */
        }

        /* Style the custom checkbox when checked */
        input[type="checkbox"]:checked+.custom-checkbox {
            background-color: #000;
            /* Change background color when checked */
        }
    </style>
@endsection

@section('content')
    <nav
        class="flex justify-between bg-gradient-to-r from-accent-1 to-accent-2 pt-8 pb-20 px-8 lg:px-16 flex-grow text-white">
        <div>
            <h1 class="font-bold lg:text-2xl">ULANGAN TENGAH SEMESTER</h1>
            <h2>Subject: Biology</h2>
        </div>
        <div class="flex flex-col text-end">
            <span class="flex lg:text-4xl text-2xl gap-x-2 items-end place-content-end">
                44:22
                <img src="/public/icons/ic_timer.svg" alt="" class="h-8 lg:h-20">
            </span>
        </div>
    </nav>

    <main class="flex flex-col lg:flex-row gap-x-8 -mt-14 lg:px-16 mb-8 px-4">
        <div class="flex flex-col gap-y-8 flex-grow">
            <div class="flex flex-col gap-y-4 bg-white shadow-button rounded-lg p-6">
                <div class="flex items-center gap-x-4">
                    <div class="flex items-center justify-center rounded-full border border-accent-2 h-10 w-10">
                        <span class="font-semibold">1</span>
                    </div>
                    <span>Multiple Choices</span>
                </div>
                <div class="flex flex-col bg-slate-100 min-h-96 rounded-lg p-4 items-center overflow-hidden">
                    <p class="whitespace-pre-line w-full lg:text-lg ">Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Vestibulum non enim in lorem facilisis finibus ut in nisl. Nulla facilisi. Phasellus
                        placerat justo ac feugiat congue. Donec in laoreet dolor, vel pulvinar nulla. Morbi vel lectus
                        eros. Nunc consequat interdum odio, sit amet laoreet velit condimentum ac. Fusce sodales mi in
                        dui ultrices lobortis. Nulla in varius leo, non commodo quam. Vivamus et tristique est. Aenean
                        eget tempus eros, nec imperdiet augue. Proin luctus, velit congue facilisis elementum, lectus
                        libero maximus turpis, sit amet suscipit augue est vel nulla. Nulla laoreet nulla a luctus
                        placerat. Nulla tincidunt eros vitae libero volutpat viverra. Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit. Vestibulum non enim in lorem facilisis finibus ut in nisl. Nulla
                        facilisi. Phasellus placerat justo ac feugiat congue. Donec in laoreet dolor, vel pulvinar
                        nulla. Morbi vel lectus eros.
                    </p>
                    <img src="/public/images/images.jpg" class="max-h-72 max-w-fit my-4 " alt="">
                </div>
                <span class="text-gray-400">Select your answer on the options below:</span>
                <div class="flex flex-col gap-4">
                    <label class="choice-button">
                        <input type="checkbox" value="1">
                        <span class="custom-checkbox"></span>
                        a ) <span class="ml-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                    </label>
                    <label class="choice-button">
                        <input type="checkbox" value="2">
                        <span class="custom-checkbox"></span>
                        b ) <span class="ml-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                    </label>
                    <label class="choice-button">
                        <input type="checkbox" value="3">
                        <span class="custom-checkbox"></span>
                        c ) <span class="ml-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                    </label>
                    <label class="choice-button">
                        <input type="checkbox" value="4">
                        <span class="custom-checkbox"></span>
                        d ) <span class="ml-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                    </label>
                    <label class="choice-button">
                        <input type="checkbox" value="5">
                        <span class="custom-checkbox"></span>
                        e ) <span class="ml-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                    </label>
                </div>


            </div>
            <div class="flex flex-col gap-y-8 text-">
                <div class="flex justify-between shadow-button">
                    <button class="bg-white rounded-l-xl px-6 py-4 flex-grow">Clear Respones</button>
                    <button class="bg-white border-l-2 px-6 py-4 flex-grow">Mark For Now</button>
                    <button class="bg-white border-x-2 px-6 py-4 flex-grow">Mark For Review</button>
                    <button class="bg-white rounded-r-xl px-6 py-4 flex-grow">Save</button>
                </div>
                <div class="flex justify-start shadow-button">
                    <a href="/src/assessment.html"
                        class="bg-white text-center rounded-l-xl px-6 py-4 flex-grow">Previous</a>
                    <a href="/src/cbt-2.html" class="bg-white text-center rounded-r-xl border-l-2 px-6 py-4 flex-grow">Save
                        & Next</a>
                </div>
            </div>
        </div>
        <div
            class="flex flex-col bg-white shadow-button rounded-lg min-h-screen flex-grow lg:max-w-[400px] mt-8 lg:mt-0 shrink-0 ">
            <div class="border-b">
                <div class="flex py-6 px-8 gap-x-4">
                    <img src="/public/images/img_dashboard_maleStudent.png" class="w-32 h-32" alt="">
                    <div class="flex flex-col py-2 gap-y-2 overflow-x-hidden">
                        <span class="font-semibold ">STUDENT'S FULL NAME</span>
                        <span>STUDENT ID</span>
                        <span>STUDENT CLASS</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-5 justify-items-center py-4 px-4 gap-y-6">
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl text-white bg-accent-1">1</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border-4 border-accent-1">2</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl text-white bg-orange-300">3</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl text-white bg-accent-2">4</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">5</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">6</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">7</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">8</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">9</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">10</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">11</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">12</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">13</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">14</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">15</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">16</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">17</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">18</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">19</button>
                <button class="shadow-md rounded-xl w-12 h-12 font-semibold text-xl border">20</button>
            </div>
            <div class="flex-grow">
            </div>
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
                    <div class="w-5 h-5 rounded-md bg-orange-300 shadow"></div>Marked
                </span>
                <span class="flex gap-x-2 px-4">
                    <div class="w-5 h-5 rounded-md bg-accent-2 shadow"></div>Marked For Review
                </span>
            </div>
        </div>
    </main>
@endsection

@section('script')
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
