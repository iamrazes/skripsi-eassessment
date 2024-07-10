@extends('layouts.app')

@section('title')
    <title>My Profile - {{ config('app.name') }}</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('student-access'))
        <!-- Student Profile -->
        <div class="flex flex-col mx-4 lg:mx-0">
            <div class="rounded-xl shadow-button bg-gradient-to-r from-accent-1 to-accent-2 mt-4 lg:mt-8 py-4 lg:py-8">
                <div
                    class="flex flex-col items-center gap-x-8 z-0 justify-center lg:justify-start mx-4 lg:mx-16">
                    <div
                        class="w-40 h-40 border-4 border-white rounded-full overflow-hidden shadow-button flex-shrink-0 lg:-ml-0">
                        <img src="{{ asset($dataStudent->gender == 'Male' ? 'images/img_dashboard_maleStudent.png' : 'images/img_dashboard_femaleStudent.png') }}"
                            class="w-full h-full" alt="Student Image">
                    </div>
                    <div class="flex flex-col text-white pt-3 items-center">
                        <h1 class="text-3xl font-semibold line-clamp-1 text-start overflow-clip uppercase">
                            {{ auth()->user()->name }}</h1>
                        <span class="text-lg mt-1 font-semibold capitalize">
                            {{ auth()->user()->roles->pluck('name')->implode(', ') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-button pt-6 pb-16 my-8 mx-4 lg:mx-0">
            <div class="font-semibold text-lg pb-6 border-b"><span class="px-6">Profile Information</span></div>
            <div class="flex flex-col py-6 gap-y-4 px-6">
                <div class="flex flex-col gap-y-1">
                    <span class="font-semibold">Full Name:</span>
                    <div class="bg-gray-100 rounded-lg py-2 px-3">
                        <span>{{ $dataStudent->user->name }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-y-1">
                    <span class="font-semibold">Student ID:</span>
                    <div class="bg-gray-100 rounded-lg py-2 px-3">
                        <span>{{ $dataStudent->student_id }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-y-1">
                    <span class="font-semibold">Email:</span>
                    <div class="bg-gray-100 rounded-lg py-2 px-3">
                        <span>{{ $dataStudent->user->email }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-y-1">
                    <span class="font-semibold">Gender:</span>
                    <div class="bg-gray-100 rounded-lg py-2 px-3">
                        <span>{{ ucfirst($dataStudent->gender) }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-y-1">
                    <span class="font-semibold">Classroom:</span>
                    <div class="bg-gray-100 rounded-lg py-2 px-3">
                        <span>{{ $dataStudent->classroom->name ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->hasPermissionTo('teacher-access'))
        <!-- Teacher Profile -->
        <div class="flex flex-col mx-4">
            <div class="rounded-xl shadow-button bg-gradient-to-r from-accent-1 to-accent-2 mt-4 lg:mt-8 py-4 lg:py-8">
                <div
                    class="flex flex-col items-center lg:flex-row lg:items-start gap-x-8 z-0 justify-center lg:justify-start mx-4 lg:mx-16">
                    <div
                        class="w-40 h-40 border-4 border-white rounded-full overflow-hidden shadow-button flex-shrink-0 lg:-ml-0">
                        <img src="{{ asset('images/img_dashboard_admin.png') }}" class="w-full h-full" alt="">
                    </div>
                    <div class="flex flex-col text-white pt-3 lg:items-start items-center">
                        <h1
                            class="xl:text-3xl text-lg lg:mt-0 mt-2 font-semibold lg:text-start text-center overflow-clip uppercase">
                            {{ auth()->user()->name }}</h1>
                        <span class="lg:text-lg mt-1 lg:font-semibold capitalize">
                            {{ auth()->user()->roles->pluck('name')->implode(', ') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row mx-4 gap-8 mt-8 pb-8">
            <div class="rounded-2xl shadow-button bg-white lg:w-1/3 py-4 lg:py-8 flex-shrink-0 overflow-clip">
                <div class="flex flex-col gap-y-2 xl:gap-y-4">
                    <h1 class=" font-semibold pb-4 border-b"><span class="px-4 xl:px-8 xl:text-xl text-lg">Profile
                            Information</span></h1>
                    <div class="flex flex-col justify-between px-4 xl:px-8">
                        <span class="font-semibold">Full Name:</span>
                        <span>{{ $dataTeacher->user->name }}</span>
                    </div>
                    <div class="flex flex-col justify-between px-4 xl:px-8">
                        <span class="font-semibold">Email:</span>
                        <span>{{ $dataTeacher->user->email }}</span>
                    </div>
                    <div class="flex flex-col justify-between px-4 xl:px-8">
                        <span class="font-semibold">Contact:</span>
                        <span>{{ $dataTeacher->contact }}</span>
                    </div>
                    <div class="flex flex-col justify-between px-4 xl:px-8">
                        <span class="font-semibold">Address:</span>
                        <span>{{ $dataTeacher->address }}</span>
                    </div>
                    <div class="flex flex-col justify-between px-4 xl:px-8">
                        <span class="font-semibold">Teacher ID:</span>
                        <span>{{ $dataTeacher->teacher_id }}</span>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl shadow-button bg-white w-full py-4 lg:py-8 hidden lg:block">
                <div class="flex flex-col">
                    <div class="pb-4">
                        <h1 class="text-xl font-semibold px-4 lg:px-8">Recent Assessment</h1>
                        <span class="flex text-center text-xs gap-x-1 text-textColorDisabled mt-2 px-4 lg:px-8"><img
                                src="{{ asset('icons/ic_docs2.svg') }}" class="w-3" alt="">Showing your 10
                            recent
                            test</span>
                    </div>
                    <div class="overflow-x-auto ">
                        <table class="min-w-full divide-y divide-gray-200 border-b border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                        Date Created
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                        Type
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                        Subject
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium  uppercase tracking-wider">
                                        Option
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($exams as $exam)
                                    <tr>
                                        <td scope="col" class="pl-6 py-3 text-left line-clamp-1">{{ $exam->created_at }}</td>
                                        <td scope="col" class="pl-6 py-3 text-left ">{{ $exam->examType->name }}</td>
                                        <td scope="col" class="pl-6 py-3 text-left ">{{ $exam->subject->name }}</td>
                                        <td scope="col" class="pl-6 py-3 text-left capitalize">{{ $exam->status }}</td>
                                        <td scope="col" class="pr-6 py-3 text-right ">
                                            <a
                                                href="{{ route('teacher.exams.show', $exam->id) }}"
                                                class="font-medium text-accent-1 hover:text-accent-2">Review</a>
                                                </td>
                                    </tr>
                                @endforeach
                                <!-- Repeat the same structure for other rows -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->hasPermissionTo('admin-access'))
        <!-- admin Profile -->
        <div class="flex flex-col">
            <div class="rounded-xl shadow-button bg-gradient-to-r from-accent-1 to-accent-2 mt-8 py-28 lg:py-36">
            </div>
            <div class="flex items-start -mt-24 gap-x-8 z-0 justify-center lg:justify-start mx-4 lg:mx-16">
                <div class="w-40 h-40 border-4 border-white rounded-full overflow-hidden shadow-button flex-shrink-0">
                    <img src="{{ asset('images/img_dashboard_admin.png') }}" class="w-full h-full" alt="">
                </div>
                <div class="flex flex-col text-white pt-3">
                    <h1 class="text-3xl font-semibold line-clamp-1 text-start overflow-clip uppercase">
                        {{ auth()->user()->name }}</h1>
                    <span class="text-lg mt-1 font-semibold capitalize">
                        {{ auth()->user()->roles->pluck('name')->implode(', ') }}
                    </span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-button pt-6 pb-16 my-8">
            <div class="font-semibold text-lg pb-6 border-b"><span class="px-6">Profile Information</span></div>
            <div class="flex flex-col py-6 gap-y-4 px-6">
                <div class="flex flex-col gap-y-1">
                    <span class="font-semibold">Full Name:</span>
                    <div class="bg-gray-100 rounded-lg py-2 px-3">
                        <span>{{ $dataAdmin->user->name }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-y-1">
                    <span class="font-semibold">Admin ID:</span>
                    <div class="bg-gray-100 rounded-lg py-2 px-3">
                        <span>{{ $dataAdmin->admin_id }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-y-1">
                    <span class="font-semibold">Email:</span>
                    <div class="bg-gray-100 rounded-lg py-2 px-3">
                        <span>{{ $dataAdmin->user->email }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-y-1">
                    <span class="font-semibold">Contact:</span>
                    <div class="bg-gray-100 rounded-lg py-2 px-3">
                        <span>{{ $dataAdmin->contact }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-y-1">
                    <span class="font-semibold">Address:</span>
                    <div class="bg-gray-100 rounded-lg py-2 px-3">
                        <span>{{ $dataAdmin->address }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection


@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const itemsPerPage = 10;
            let currentPage = 1;

            const table = document.getElementById('resultsTable');
            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const totalPages = Math.ceil(rows.length / itemsPerPage);

            function renderTable(page) {
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                rows.forEach((row, index) => {
                    const numberingCell = row.querySelector('.numbering-cell');
                    if (index >= start && index < end) {
                        row.style.display = '';
                        numberingCell.textContent = (index + 1) +
                            "."; // Add a period at the end of the number
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            function renderPaginationButtons() {
                const paginationContainer = document.getElementById('pagination');
                paginationContainer.innerHTML = '';

                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement('button');
                    button.className =
                        `pagination-button ${i === currentPage ? 'bg-accent-1' : 'bg-accent-3'} w-8 h-8 rounded text-white font-semibold`;
                    button.innerText = i;
                    button.addEventListener('click', () => {
                        currentPage = i;
                        renderTable(currentPage);
                        updatePaginationButtons();
                    });
                    paginationContainer.appendChild(button);
                }
            }

            function updatePaginationButtons() {
                const paginationButtons = document.querySelectorAll('.pagination-button');
                paginationButtons.forEach(button => {
                    if (parseInt(button.innerText) === currentPage) {
                        button.classList.remove('bg-accent-3');
                        button.classList.add('bg-accent-1');
                    } else {
                        button.classList.remove('bg-accent-1');
                        button.classList.add('bg-accent-3');
                    }
                });
            }

            renderTable(currentPage);
            renderPaginationButtons();
        });
    </script>
@endsection
