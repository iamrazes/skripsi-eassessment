@extends('layouts.dashboard')

@section('title')
<title>Assessments - {{ config('app.name') }}</title>
@endsection

@section('content')


        <!-- Content Here -->
        <div class="rounded-xl border-2 border-accent-1 p-5 bg-white mt-8 shadow-button">
            <div class="flex flex-col items-center justify-center text-center gap-y-2.5">
                <img src="{{asset('images/img_dashboard_maleStudent.png')}}" class="w-28 h-28 mt-1" alt="">
                <h1 class="font-bold text-accent-1 uppercase text-2xl">STUDENT FULL NAME</h1>
                <span>STUDENT'S SCHOOL ID</span>
                <span>STUDENT'S CLASS</span>
            </div>
        </div>

        <div class="flex flex-col rounded-lg shadow-button mt-8 bg-white">
            <div class="border-b py-4">
                <h1 class="text-xl font-semibold px-8">Available Test</h1>
            </div>
            <div class="flex flex-col lg:flex-row gap-4 lg:gap-8 justify-center p-8">
                <div class="rounded-3xl w-full border-4 border-accent-2 p-4 ">
                    <div class="flex flex-col justify-between">
                        <div>
                            <div class="w-20 h-20">
                                <img src="{{asset('icons/ic_assessment1.svg')}}" class="w-full h-full" alt="">
                            </div>
                            <div class="flex flex-col gap-y-2 px-3 mt-3">
                                <h1 class="font-semibold text-3xl">Bahasa Inggris</h1>
                                <span>Ulangan Harian</span>
                            </div>
                            <div class="flex flex-col px-3 mt-3">
                                <span>Schedule:</span>
                                <div class="flex flex-col lg:flex-row lg:justify-between">
                                    <span>Friday, 26 April 2024</span>
                                    <span>08:00 - 09:00</span>
                                </div>
                            </div>
                            <div class="flex flex-col px-3">
                                <span>Time:</span>
                                <span>60 Minutes</span>
                            </div>
                        </div>

                        <div class="h-20 lg:h-40">
                        </div>

                        <a href="/src/cbt-1.html"
                            class="rounded-2xl min-w-max p-4 bg-gradient-to-t m-3 from-accent-1 text-center to-accent-2 text-white shadow font-semibold">Proceed</a>

                    </div>
                </div>
                <div class="rounded-3xl w-full border-4 border-accent-2 p-4 ">
                    <div class="flex flex-col justify-between">
                        <div>
                            <div class="w-20 h-20">
                                <img src="{{asset('icons/ic_assessment1.svg')}}" class="w-full h-full" alt="">
                            </div>
                            <div class="flex flex-col gap-y-2 px-3 mt-3">
                                <h1 class="font-semibold text-3xl">Bahasa Inggris</h1>
                                <span>Ulangan Harian</span>
                            </div>
                            <div class="flex flex-col px-3 mt-3">
                                <span>Schedule:</span>
                                <div class="flex flex-col lg:flex-row lg:justify-between">
                                    <span>Friday, 26 April 2024</span>
                                    <span>08:00 - 09:00</span>
                                </div>
                            </div>
                            <div class="flex flex-col px-3">
                                <span>Time:</span>
                                <span>60 Minutes</span>
                            </div>
                        </div>

                        <div class="h-20 lg:h-40">
                        </div>

                        <a
                            class="rounded-2xl min-w-max p-4 bg-gradient-to-t m-3 shadow bg-gray-50 text-textColorDisabled text-center font-semibold">Unavailabe</a>

                    </div>
                </div>
                <div class="rounded-3xl w-full border-2 border-textColorDisabled text-textColorDisabled p-4 ">
                    <div class="flex flex-col justify-between">
                        <div>
                            <div class="w-20 h-20">
                                <img src="{{asset('icons/ic_assessment2.svg')}}" class="w-full h-full" alt="">
                            </div>
                            <div class="flex flex-col gap-y-2 px-3 mt-3">
                                <h1 class="font-semibold text-3xl">Bahasa Inggris</h1>
                                <span>Ulangan Harian</span>
                            </div>
                            <div class="flex flex-col px-3 mt-3">
                                <span>Schedule:</span>
                                <div class="flex flex-col lg:flex-row lg:justify-between">
                                    <span>Friday, 26 April 2024</span>
                                    <span>08:00 - 09:00</span>
                                </div>
                            </div>
                            <div class="flex flex-col px-3">
                                <span>Time:</span>
                                <span>60 Minutes</span>
                            </div>
                        </div>

                        <div class="h-20 lg:h-40">
                        </div>

                        <a
                            class="rounded-2xl min-w-max p-4 bg-gradient-to-t m-3 text-textColorDisabled text-center font-semibold">Unavailabe</a>

                    </div>
                </div>
            </div>
        </div>
@endsection
