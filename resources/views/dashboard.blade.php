@extends('layouts.app')

@section('title')
    <title>Dashboard - {{ config('app.name') }}</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('admin-access'))
        <!-- Admin Dashboard -->
        <div class="grid grid-cols-2 lg:grid-cols-4 mt-8 gap-4 lg:gap-x-8">
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6">
                    <img src="{{ asset('icons/ic_total_students.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-xs">Total Students</span>
                        <h1 class="font-bold text-2xl">{{ $totalStudents }}</h1>
                    </div>
                </div>
                <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span class="line-clamp-1">Report
                            a
                            problem</span></a>
                </div>
            </div>
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6">
                    <img src="{{ asset('icons/ic_male_student.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-xs">Male Students</span>
                        <h1 class="font-bold text-2xl">{{ $maleStudents }}</h1>
                    </div>
                </div>
                <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span class="line-clamp-1">Report
                            a
                            problem</span></a>
                </div>
            </div>
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6">
                    <img src="{{ asset('icons/ic_female_student.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-xs">Female Students</span>
                        <h1 class="font-bold text-2xl">{{ $femaleStudents }}</h1>
                    </div>
                </div>
                <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span class="line-clamp-1">Report
                            a
                            problem</span></a>
                </div>
            </div>
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6">
                    <img src="{{ asset('icons/ic_total_teachers.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-xs">Total Teachers</span>
                        <h1 class="font-bold text-2xl">{{ $totalTeachers }}</h1>
                    </div>
                </div>
                <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span
                            class="line-clamp-1">Report
                            a
                            problem</span></a>
                </div>
            </div>
        </div>
        <div class="flex lg:flex-row flex-col-reverse mt-4 lg:mt-8 gap-y-4 lg:gap-x-8">
            <div
                class="flex  flex-col gap-y-2 bg-gradient-to-r from-accent-1 to-accent-2 p-6 rounded-lg shadow-button text-white">
                <img src="{{ asset('icons/ic_docs.svg') }}" class="w-24" alt="">
                <h1 class="font-semibold text-2xl">Documentations</h1>
                <span>Learn properly on how to use e-assessment website, step-by-step, <br>
                    and tips. Understand the basics to implemented on your assessment <br>and classes. </span>

                <a href="" class="flex gap-x-1 mt-1 items-center text-end font-semibold">
                    <img src="{{ asset('icons/ic_more.svg') }}" class="h-5" alt="">
                    <span class="text-sm">Click Here</span>
                </a>
            </div>
            <div class="flex  flex-grow flex-col bg-white p-6 rounded-lg shadow-button">
                <div class="flex justify-between gap-x-2 ">
                    <div class="flex gap-x-2">
                        <img src="{{ asset('icons/ic_calendar.svg') }}" class="w-6" alt="">
                        <span class="font-bold">Calendar</span>
                    </div>
                    <span class="font-bold" id="Calendar"></span>
                </div>
                <div id="calendar" class="mt-4"></div>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row mt-4 lg:mt-8 lg:gap-x-8 gap-y-4">
            <div class="flex flex-col flex-grow bg-white rounded-lg shadow-button">
                <div class="flex justify-between p-6">
                    <div>
                        <!-- table title -->
                        <h1 class="font-bold">Active Teacher</h1>
                        <span class="flex text-xs gap-x-1 mt-1">
                            <img src="{{ asset('icons/ic_active_teachers.svg') }}" alt="">
                            Total 30 Active Teacher</span>
                    </div>
                    <a href="#">
                        <img src="{{ asset('icons/ic_dots.svg') }}" class="h-4" alt="">
                    </a>
                </div>
                <div class="overflow-x-auto pb-2 rounded-b-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-white">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Subject Taught
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Test Created
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Last Activity
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white ">
                            <tr class="bg-white pt-3">
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img src="{{ asset('images/img_dashboard_admin.png') }}" class="w-4 h-4 mr-2"
                                            alt="">
                                        <span class="text-sm">Teacher's Name</span>
                                    </div>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img src="{{ asset('images/img_dashboard_admin.png') }}" class="w-4 h-4 mr-2"
                                            alt="">
                                        <span class="text-sm">Teacher's Name</span>
                                    </div>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img src="{{ asset('images/img_dashboard_admin.png') }}" class="w-4 h-4 mr-2"
                                            alt="">
                                        <span class="text-sm">Teacher's Name</span>
                                    </div>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img src="{{ asset('images/img_dashboard_admin.png') }}" class="w-4 h-4 mr-2"
                                            alt="">
                                        <span class="text-sm">Teacher's Name</span>
                                    </div>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img src="{{ asset('images/img_dashboard_admin.png') }}" class="w-4 h-4 mr-2"
                                            alt="">
                                        <span class="text-sm">Teacher's Name</span>
                                    </div>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img src="{{ asset('images/img_dashboard_admin.png') }}" class="w-4 h-4 mr-2"
                                            alt="">
                                        <span class="text-sm">Teacher's Name</span>
                                    </div>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <span class="text-sm">asdasd</span>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="flex flex-col bg-white rounded-lg shadow-button flex-grow">
                <div class="pb-6 pt-6 px-6">
                    <h1 class="font-bold">Recently Added Test</h1>
                </div>
                <div class="border-t py-6 ">
                    <div class="flex flex-col gap-y-4">
                        <div class="border-b pb-3">
                            <div class="flex lg:justify-between gap-x-4 px-6">
                                <div
                                    class="bg-gradient-to-r from-accent-1 to-accent-2 py-2 px-8 rounded-xl -mt-1 text-white font-bold text-xs">
                                    02/24 </div>
                                <span>Bahasa Indonesia</span>
                            </div>
                        </div>
                        <div class="border-b pb-3">
                            <div class="flex lg:justify-between gap-x-4 px-6">
                                <div
                                    class="bg-gradient-to-r from-accent-1 to-accent-2 py-2 px-8 rounded-xl -mt-1 text-white font-bold text-xs">
                                    02/24 </div>
                                <span>Bahasa Indonesia</span>
                            </div>
                        </div>
                        <div class="border-b pb-3">
                            <div class="flex lg:justify-between gap-x-4 px-6">
                                <div
                                    class="bg-gradient-to-r from-accent-1 to-accent-2 py-2 px-8 rounded-xl -mt-1 text-white font-bold text-xs">
                                    02/24 </div>
                                <span>Bahasa Indonesia</span>
                            </div>
                        </div>
                        <div class="border-b pb-3">
                            <div class="flex lg:justify-between gap-x-4 px-6">
                                <div
                                    class="bg-gradient-to-r from-accent-1 to-accent-2 py-2 px-8 rounded-xl -mt-1 text-white font-bold text-xs">
                                    02/24 </div>
                                <span>Bahasa Indonesia</span>
                            </div>
                        </div>
                        <div class="border-b pb-3">
                            <div class="flex lg:justify-between gap-x-4 px-6">
                                <div
                                    class="bg-gradient-to-r from-accent-1 to-accent-2 py-2 px-8 rounded-xl -mt-1 text-white font-bold text-xs">
                                    02/24 </div>
                                <span>Bahasa Indonesia</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->hasPermissionTo('teacher-access'))
        <!-- Admin Dashboard -->
        <div class="grid grid-cols-2 lg:grid-cols-4 mx-4 mt-4 lg:mx-0 lg:mt-8 gap-4 lg:gap-x-8">
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6">
                    <img src="{{ asset('icons/ic_total_students.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-md">Total Students</span>
                        <h1 class="font-bold text-2xl">{{ $totalStudents }}</h1>
                    </div>
                </div>
                <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span
                            class="line-clamp-1">Report
                            a
                            problem</span></a>
                </div>
            </div>
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6">
                    <img src="{{ asset('icons/ic_male_student.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-md">Male Students</span>
                        <h1 class="font-bold text-2xl">{{ $maleStudents }}</h1>
                    </div>
                </div>
                <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span
                            class="line-clamp-1">Report
                            a
                            problem</span></a>
                </div>
            </div>
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6">
                    <img src="{{ asset('icons/ic_female_student.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-md">Female Students</span>
                        <h1 class="font-bold text-2xl">{{ $femaleStudents }}</h1>
                    </div>
                </div>
                <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span
                            class="line-clamp-1">Report
                            a
                            problem</span></a>
                </div>
            </div>
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6">
                    <img src="{{ asset('icons/ic_total_teachers.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-md">Total Teachers</span>
                        <h1 class="font-bold text-2xl">{{ $totalTeachers }}</h1>
                    </div>
                </div>
                <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span
                            class="line-clamp-1">Report
                            a
                            problem</span></a>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->hasPermissionTo('student-access'))
        <!-- Student Dashboard -->
        <div class="rounded-xl border-2 border-accent-1 p-5 bg-white lg:mt-8 mt-4 shadow-button mx-4 lg:mx-0">
            <div class="flex flex-col items-center justify-center text-center gap-y-2.5">
                <img src="{{ asset($dataStudent->gender == 'male' ? 'images/img_dashboard_maleStudent.png' : 'images/img_dashboard_femaleStudent.png') }}"
                    class="w-28 h-28 mt-1" alt="">
                <h1 class="font-bold text-accent-1 uppercase text-2xl">{{ auth()->user()->name }}</h1>
                <span>{{ $dataStudent->student_id }}</span>
                <span>{{ $dataStudent->classroom->name ?? 'N/A' }}</span>
            </div>
        </div>
        <div class="grid lg:grid-cols-2 gap-y-4 lg:gap-y-8 my-8 gap-x-8 mx-4 lg:mx-0">
            <div class="bg-white rounded-md shadow-button p-4 lg:p-8 flex flex-col justify-between">
                <div class="flex flex-col gap-y-2">
                    <div class="flex lg:flex-col gap-x-3">
                        <img src="{{ asset('icons/ic_big_assessments.svg') }}" class="lg:w-20 mb-2 lg:h-20 w-10 h-10"
                            alt="">
                        <h1 class="text-accent-1 text-3xl font-semibold">Exams</h1>
                    </div>
                    <span class="text-sm lg:text-lg lg:w-3/4">Online Assessment curated and created by your
                        school and teacher. See if you have any assessment available
                        for you by clicking link above.</span>
                </div>
                <a href="" class="flex gap-x-1 place-content-end text-accent-1 font-semibold mt-2"><img
                        src="{{ asset('icons/ic_more2.svg') }}" alt=""> Click Here</a>
            </div>
            <div class="bg-white rounded-md shadow-button p-4 lg:p-8 flex flex-col justify-between">
                <div class="flex flex-col gap-y-2">
                    <div class="flex lg:flex-col gap-x-3">
                        <img src="{{ asset('icons/ic_big_results.svg') }}" class="lg:w-20 mb-2 lg:h-20 w-10 h-10"
                            alt="">
                        <h1 class="text-accent-1 text-3xl font-semibold">Reports</h1>
                    </div>
                    <span class="text-sm lg:text-lg lg:w-3/4">All of your assessment are recorded within our
                        database. You can check, review, or learn your old test with the given right answers.
                    </span>
                </div>
                <a href="" class="flex gap-x-1 place-content-end text-accent-1 font-semibold mt-2"><img
                        src="{{ asset('icons/ic_more2.svg') }}" alt=""> Click Here</a>
            </div>
            <div class="bg-white rounded-md shadow-button p-4 lg:p-8 flex flex-col justify-between">
                <div class="flex flex-col gap-y-2">
                    <div class="flex lg:flex-col gap-x-3">
                        <img src="{{ asset('icons/ic_big_profile.svg') }}" class="lg:w-20 mb-2 lg:h-20 w-10 h-10"
                            alt="">
                        <h1 class="text-accent-1 text-3xl font-semibold">My Profile</h1>
                    </div>
                    <span class="text-sm lg:text-lg lg:w-3/4">Check your identifications, all of your data
                        stored private and secure in school database.</span>
                </div>
                <a href="" class="flex gap-x-1 place-content-end text-accent-1 font-semibold mt-2"><img
                        src="{{ asset('icons/ic_more2.svg') }}" alt=""> Click Here</a>
            </div>
            <div
                class="bg-gradient-to-r from-accent-1 to-accent-2 text-white rounded-md shadow-button p-4 lg:p-8 flex flex-col justify-between">
                <div class="flex flex-col gap-y-2">
                    <div class="flex lg:flex-col gap-x-3">
                        <img src="{{ asset('icons/ic_big_docs.svg') }}" class="lg:w-20 mb-2 lg:h-20 w-10 h-10"
                            alt="">
                        <h1 class="text-white  text-3xl font-semibold">Documentations</h1>
                    </div>
                    <span class="text-sm lg:text-lg lg:w-3/4">Learn properly on how to use e-assessment
                        website, the basics and rules. Understand it to avoid mistake and error.</span>
                </div>
                <a href="" class="flex gap-x-1 place-content-end text-white font-semibold mt-2"><img
                        src="{{ asset('icons/ic_more.svg') }}" alt=""> Click Here</a>
            </div>
            <!-- Repeat the same structure for other cards -->
        </div>
    @endif
@endsection

@section('script')
    <script>
        var currentDate = new Date();
        var month = currentDate.toLocaleString('default', {
            month: 'long'
        });
        var year = currentDate.getFullYear();
        document.getElementById("Calendar").innerHTML = month + ", " + year;
    </script>
@endsection
