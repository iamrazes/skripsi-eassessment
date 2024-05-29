@extends('layouts.dashboard')

@section('title')
    <title>My Profile - {{ config('app.name') }}</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('student-access'))
        <!-- Student Profile -->
        <div class="flex flex-col">
            <div class="rounded-xl shadow-button bg-gradient-to-r from-accent-1 to-accent-2 mt-8 py-28 lg:py-36">
            </div>
            <div class="flex items-start -mt-24 gap-x-8 z-0 justify-center lg:justify-start mx-4 lg:mx-16">
                <div class="w-40 h-40 border-4 border-white rounded-full overflow-hidden shadow-button flex-shrink-0">
                    <img src="{{ asset('images/img_dashboard_maleStudent.png') }}" class="w-full h-full" alt="">
                </div>
                <div class="flex flex-col text-white pt-3">
                    <h1 class="text-3xl font-semibold line-clamp-1 text-start overflow-clip uppercase">{{ auth()->user()->name }}</h1>
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
                        <span>{{ auth()->user()->name }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-y-1">
                    <span class="font-semibold">NIS:</span>
                    <div class="bg-gray-100 rounded-lg py-2 px-3">
                        <span>78324456200332001</span>
                    </div>
                </div>
                <div class="flex flex-col gap-y-1">
                    <span class="font-semibold">NISN:</span>
                    <div class="bg-gray-100 rounded-lg py-2 px-3">
                        <span>19040290013</span>
                    </div>
                </div>
                <div class="flex flex-col gap-y-1">
                    <span class="font-semibold">Grade:</span>
                    <div class="bg-gray-100 rounded-lg py-2 px-3">
                        <span>12 A</span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->hasPermissionTo('teacher-access'))
        <!-- Teacher Profile -->
        <div class="flex flex-col">
            <div class="rounded-xl shadow-button bg-gradient-to-r from-accent-1 to-accent-2 mt-8 py-28 lg:py-36">
            </div>
            <div class="flex items-start -mt-24 gap-x-8 z-0 justify-center lg:justify-start mx-4 lg:mx-16">
                <div class="w-40 h-40 border-4 border-white rounded-full overflow-hidden shadow-button flex-shrink-0">
                    <img src="{{ asset('images/img_dashboard_admin.png') }}" class="w-full h-full" alt="">
                </div>
                <div class="flex flex-col text-white pt-3">
                    <h1 class="text-3xl font-semibold line-clamp-1 text-start overflow-clip uppercase">{{ auth()->user()->name }}</h1>
                    <span class="text-lg mt-1 font-semibold capitalize">
                        {{ auth()->user()->roles->pluck('name')->implode(', ') }}
                    </span>
                </div>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row gap-8 mt-8 pb-8">
            <div class="rounded-2xl shadow-button bg-white lg:w-1/3 p-4 flex-shrink-0 overflow-clip">
                <div class="flex flex-col p-4 gap-y-4">
                    <h1 class="text-xl font-semibold mb-4">Profile Information</h1>
                    <div class="flex justify-between">
                        <span class="font-semibold">Full Name:</span>
                        <span>{{ auth()->user()->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Contact:</span>
                        <span>(62) 899 7788 3322</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Email:</span>
                        <span>adminemailaddress@gmail.com</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Subject:</span>
                        <span>Subject</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">NUPTK:</span>
                        <span>73278234879897</span>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl shadow-button bg-white w-full py-8">
                <div class="flex flex-col">
                    <div class=" pb-4">
                        <h1 class="text-xl font-semibold px-8">Recent Assessment</h1>
                        <span class="flex text-center text-xs gap-x-1 text-textColorDisabled mt-2 px-8"><img
                                src="{{ asset('icons/ic_docs2.svg') }}" class="w-3" alt="">Showing your 10 recent
                            test</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 border-b border-gray-200">
                            <thead class="">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                        Date Created
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
                                        class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                        Option
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="bg-white divide-gray-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ asset('icons/ic_ongoing.svg') }}" class="w-6 mr-2" alt="">
                                            <span class="text-sm">21 - 04 - 2024</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Subject: Bahasa Indonesia</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Ongoing</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-bold text-accent-1">Review</span>
                                    </td>
                                </tr>
                                <tr class="bg-white divide-gray-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ asset('icons/ic_failed.svg') }}" class="w-6 mr-2" alt="">
                                            <span class="text-sm">21 - 04 - 2024</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Subject: Bahasa Indonesia</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Canceled</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-bold text-accent-1">Review</span>
                                    </td>
                                </tr>
                                <tr class="bg-white divide-gray-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ asset('icons/ic_success.svg') }}" class="w-6 mr-2"
                                                alt="">
                                            <span class="text-sm">21 - 04 - 2024</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Subject: Bahasa Indonesia</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-bold text-accent-1">Review</span>
                                    </td>
                                </tr>
                                <tr class="bg-white divide-gray-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ asset('icons/ic_success.svg') }}" class="w-6 mr-2"
                                                alt="">
                                            <span class="text-sm">21 - 04 - 2024</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Subject: Bahasa Indonesia</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-bold text-accent-1">Review</span>
                                    </td>
                                </tr>
                                <tr class="bg-white divide-gray-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ asset('icons/ic_success.svg') }}" class="w-6 mr-2"
                                                alt="">
                                            <span class="text-sm">21 - 04 - 2024</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Subject: Bahasa Indonesia</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-bold text-accent-1">Review</span>
                                    </td>
                                </tr>
                                <tr class="bg-white divide-gray-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ asset('icons/ic_success.svg') }}" class="w-6 mr-2"
                                                alt="">
                                            <span class="text-sm">21 - 04 - 2024</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Subject: Bahasa Indonesia</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-bold text-accent-1">Review</span>
                                    </td>
                                </tr>
                                <tr class="bg-white divide-gray-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ asset('icons/ic_success.svg') }}" class="w-6 mr-2"
                                                alt="">
                                            <span class="text-sm">21 - 04 - 2024</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Subject: Bahasa Indonesia</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-bold text-accent-1">Review</span>
                                    </td>
                                </tr>
                                <tr class="bg-white divide-gray-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ asset('icons/ic_success.svg') }}" class="w-6 mr-2"
                                                alt="">
                                            <span class="text-sm">21 - 04 - 2024</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Subject: Bahasa Indonesia</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-bold text-accent-1">Review</span>
                                    </td>
                                </tr>
                                <tr class="bg-white divide-gray-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ asset('icons/ic_success.svg') }}" class="w-6 mr-2"
                                                alt="">
                                            <span class="text-sm">21 - 04 - 2024</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Subject: Bahasa Indonesia</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-bold text-accent-1">Review</span>
                                    </td>
                                </tr>
                                <tr class="bg-white divide-gray-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ asset('icons/ic_success.svg') }}" class="w-6 mr-2"
                                                alt="">
                                            <span class="text-sm">21 - 04 - 2024</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Subject: Bahasa Indonesia</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-bold text-accent-1">Review</span>
                                    </td>
                                </tr>
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
                    <h1 class="text-3xl font-semibold line-clamp-1 text-start overflow-clip uppercase">{{ auth()->user()->name }}</h1>
                    <span class="text-lg mt-1 font-semibold capitalize">
                        {{ auth()->user()->roles->pluck('name')->implode(', ') }}
                    </span>
                </div>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row gap-8 mt-8 pb-8">
            <div class="rounded-2xl shadow-button bg-white lg:w-full flex-shrink-0 overflow-clip">
                <div class="flex flex-col divide-y">
                    <h1 class="text-xl font-semibold py-4 px-6">Profile Information</h1>
                    <div class="flex justify-between py-3 px-6">
                        <span class="font-medium">Full Name:</span>
                        <span>{{ auth()->user()->name }}</span>
                    </div>
                    <div class="flex justify-between py-3 px-6">
                        <span class="font-medium">Contact:</span>
                        <span>(62) 899 7788 3322</span>
                    </div>
                    <div class="flex justify-between py-3 px-6">
                        <span class="font-medium">Email:</span>
                        <span>adminemailaddress@gmail.com</span>
                    </div>
                    <div class="flex justify-between py-3 px-6">
                        <span class="font-medium">Subject:</span>
                        <span>Subject</span>
                    </div>
                    <div class="flex justify-between py-3 px-6">
                        <span class="font-medium">NUPTK:</span>
                        <span>73278234879897</span>
                    </div>
                </div>
            </div>

        </div>
    @endif
@endsection

@section('script')
@endsection
