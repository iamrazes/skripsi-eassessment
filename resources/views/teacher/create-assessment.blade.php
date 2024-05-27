@extends('layouts.dashboard')

@section('title')
<title>Create Assessment - {{ config('app.name') }}</title>
@endsection

@section('content')

<div
class="flex mt-8 bg-gradient-to-r from-accent-1 to-accent-2 shadow-button py-4 px-5 text-center rounded-lg text-white font-medium gap-x-2 text-2xl">
<img src="{{asset('icons/ic_create-assessment.svg')}}" alt="" class="filter-white">
<span>Create Assessment</span>
</div>
<div class="flex flex-col lg:flex-row gap-8 mt-8">
<div class="flex flex-col gap-y-2 bg-white p-6 shadow-button w-full rounded-lg lg:w-1/2">
    <div class="relative">
        <div class="flex flex-col gap-y-2">
            <span>Selector:</span>
            <div class="relative inline-block">
                <div class="select-container">
                    <div class="selected-option shadow-button rounded-lg py-4 bg-white border px-4 text-center text-gray-400"
                        style="user-select: none;">
                        Select
                    </div>
                    <ul
                        class="options hidden absolute top-full left-0 bg-white border rounded-lg shadow-button mt-1 w-full">
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">1</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">2</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">3</li>
                    </ul>
                    <div class="absolute inset-y-0 right-0 px-4 flex items-center">
                        <!-- Add your dropdown div icon or text here -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative">
        <div class="flex flex-col gap-y-2">
            <span>Selector:</span>
            <div class="relative inline-block">
                <div class="select-container">
                    <div class="selected-option shadow-button rounded-lg py-4 bg-white border px-4 text-center text-gray-400"
                        style="user-select: none;">
                        Select
                    </div>
                    <ul
                        class="options hidden absolute top-full left-0 bg-white border rounded-lg shadow-button mt-1 w-full">
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">1</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">2</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">3</li>
                    </ul>
                    <div class="absolute inset-y-0 right-0 px-4 flex items-center">
                        <!-- Add your dropdown div icon or text here -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative">
        <div class="flex flex-col gap-y-2">
            <span>Selector:</span>
            <div class="relative inline-block">
                <div class="select-container">
                    <div class="selected-option shadow-button rounded-lg py-4 bg-white border px-4 text-center text-gray-400"
                        style="user-select: none;">
                        Select
                    </div>
                    <ul
                        class="options hidden absolute top-full left-0 bg-white border rounded-lg shadow-button mt-1 w-full">
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">1</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">2</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">3</li>
                    </ul>
                    <div class="absolute inset-y-0 right-0 px-4 flex items-center">
                        <!-- Add your dropdown div icon or text here -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative">
        <div class="flex flex-col gap-y-2">
            <span>Selector:</span>
            <div class="relative inline-block">
                <div class="select-container">
                    <div class="selected-option shadow-button rounded-lg py-4 bg-white border px-4 text-center text-gray-400"
                        style="user-select: none;">
                        Select
                    </div>
                    <ul
                        class="options hidden absolute top-full left-0 bg-white border rounded-lg shadow-button mt-1 w-full">
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">1</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">2</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">3</li>
                    </ul>
                    <div class="absolute inset-y-0 right-0 px-4 flex items-center">
                        <!-- Add your dropdown div icon or text here -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative">
        <div class="flex flex-col gap-y-2">
            <span>Selector:</span>
            <div class="relative inline-block">
                <div class="select-container">
                    <div class="selected-option shadow-button rounded-lg py-4 bg-white border px-4 text-center text-gray-400"
                        style="user-select: none;">
                        Select
                    </div>
                    <ul
                        class="options hidden absolute top-full left-0 bg-white border rounded-lg shadow-button mt-1 w-full">
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">1</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">2</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">3</li>
                    </ul>
                    <div class="absolute inset-y-0 right-0 px-4 flex items-center">
                        <!-- Add your dropdown div icon or text here -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative">
        <div class="flex flex-col gap-y-2">
            <span>Selector:</span>
            <div class="relative inline-block">
                <div class="select-container">
                    <div class="selected-option shadow-button rounded-lg py-4 bg-white border px-4 text-center text-gray-400"
                        style="user-select: none;">
                        Select
                    </div>
                    <ul
                        class="options hidden absolute top-full left-0 bg-white border rounded-lg shadow-button mt-1 w-full">
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">1</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">2</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">3</li>
                    </ul>
                    <div class="absolute inset-y-0 right-0 px-4 flex items-center">
                        <!-- Add your dropdown div icon or text here -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative">
        <div class="flex flex-col gap-y-2">
            <span>Selector:</span>
            <div class="relative inline-block">
                <div class="select-container">
                    <div class="selected-option shadow-button rounded-lg py-4 bg-white border px-4 text-center text-gray-400"
                        style="user-select: none;">
                        Select
                    </div>
                    <ul
                        class="options hidden absolute top-full left-0 bg-white border rounded-lg shadow-button mt-1 w-full">
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">1</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">2</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">3</li>
                    </ul>
                    <div class="absolute inset-y-0 right-0 px-4 flex items-center">
                        <!-- Add your dropdown div icon or text here -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative">
        <div class="flex flex-col gap-y-2">
            <span>Selector:</span>
            <div class="relative inline-block">
                <div class="select-container">
                    <div class="selected-option shadow-button rounded-lg py-4 bg-white border px-4 text-center text-gray-400"
                        style="user-select: none;">
                        Select
                    </div>
                    <ul
                        class="options hidden absolute top-full left-0 bg-white border rounded-lg shadow-button mt-1 w-full">
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">1</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">2</li>
                        <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">3</li>
                    </ul>
                    <div class="absolute inset-y-0 right-0 px-4 flex items-center">
                        <!-- Add your dropdown div icon or text here -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-col gap-y-8 w-full lg:w-1/2">
    <div class="flex flex-col gap-y-3 bg-white rounded-lg p-6 shadow-button">

        <div class="relative">
            <div class="flex flex-col gap-y-2">
                <span>Selector:</span>
                <div class="relative inline-block">
                    <div class="select-container">
                        <div class="selected-option shadow-button rounded-lg py-4 bg-white border px-4 text-center text-gray-400"
                            style="user-select: none;">
                            Select
                        </div>
                        <ul
                            class="options hidden absolute top-full left-0 bg-white border rounded-lg shadow-button mt-1 w-full">
                            <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">1</li>
                            <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">2</li>
                            <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">3</li>
                        </ul>
                        <div class="absolute inset-y-0 right-0 px-4 flex items-center">
                            <!-- Add your dropdown div icon or text here -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <span class="-mt-1 text-sm text-gray-400">Lorem ipsum dolor sit amet.</span>
            </div>
        </div>
        <div class="relative">
            <div class="flex flex-col gap-y-2">
                <span>Selector:</span>
                <div class="relative inline-block">
                    <div class="select-container">
                        <div class="selected-option shadow-button rounded-lg py-4 bg-white border px-4 text-center text-gray-400"
                            style="user-select: none;">
                            Select
                        </div>
                        <ul
                            class="options hidden absolute top-full left-0 bg-white border rounded-lg shadow-button mt-1 w-full">
                            <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">1</li>
                            <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">2</li>
                            <li class="option py-2 px-4 cursor-pointer hover:bg-accent-3">3</li>
                        </ul>
                        <div class="absolute inset-y-0 right-0 px-4 flex items-center">
                            <!-- Add your dropdown div icon or text here -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <span class="-mt-1 text-sm text-gray-400">Lorem ipsum dolor sit amet.</span>
            </div>
        </div>

        <div class="flex flex-col gap-y-2">
            <span>Input:</span>
            <textarea type="text"
                class="shadow-button border rounded-lg h-40 bg-white px-3 py-1"></textarea>
            <span class="-mt-1 text-sm text-gray-400">Lorem ipsum dolor sit amet.</span>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-button">
        <div class="py-4 border-b">
            <h1 class="px-6 font-semibold">Test Informations</h1>
        </div>
        <div class="flex justify-between py-3 px-6">
            <div class="flex flex-col">
                <span>lorem ipsum</span>
                <span>lorem ipsum</span>
                <span>lorem ipsum</span>
                <span>lorem ipsum</span>
                <span>lorem ipsum</span>
                <span>lorem ipsum</span>
            </div>
            <div class="flex flex-col">
                <span>lorem ipsum</span>
                <span>lorem ipsum</span>
                <span>lorem ipsum</span>
                <span>lorem ipsum</span>
                <span>lorem ipsum</span>
                <span>lorem ipsum</span>
            </div>
        </div>
    </div>
    <a href="/src/create-assessment-1.html"
        class="bg-gradient-to-r from-accent-1 to-accent-2 py-2 font-semibold rounded-lg shadow-button text-xl text-center text-white">
        Create
    </a>
</div>
</div>
@endsection

@section('script')

<script>
    document.addEventListener('click', function (event) {
        const selectContainers = document.querySelectorAll('.select-container');
        selectContainers.forEach(selectContainer => {
            const optionsList = selectContainer.querySelector('.options');
            if (!selectContainer.contains(event.target)) {
                optionsList.classList.add('hidden');
            }
        });
    });

    document.querySelectorAll('.select-container').forEach(selectContainer => {
        const selectedOption = selectContainer.querySelector('.selected-option');
        const optionsList = selectContainer.querySelector('.options');

        selectedOption.addEventListener('click', (event) => {
            event.stopPropagation(); // Prevent event from bubbling up to the document
            optionsList.classList.toggle('hidden');

            // Close all other option lists
            const allOptionsLists = document.querySelectorAll('.options');
            allOptionsLists.forEach(list => {
                if (list !== optionsList) {
                    list.classList.add('hidden');
                }
            });
        });

        optionsList.querySelectorAll('.option').forEach(option => {
            option.addEventListener('click', (event) => {
                event.stopPropagation(); // Prevent event from bubbling up to the document
                selectedOption.textContent = option.textContent;
                optionsList.classList.add('hidden');
            });
        });
    });
</script>
@endsection
