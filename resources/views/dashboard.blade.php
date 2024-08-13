@extends('layouts.app')

@section('title')
    <title>Dashboard - {{ config('app.name') }}</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('admin-access'))
        <!-- Admin Dashboard -->
        <div class="grid grid-cols-2 lg:grid-cols-4 mt-4 lg:mt-8 gap-4 lg:gap-x-8 mx-4 lg:mx-0">
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6">
                    <img src="{{ asset('icons/ic_total_students.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-md lg:whitespace-nowrap">Jumlah Students</span>
                        <h1 class="font-bold text-2xl">{{ $totalStudents }}</h1>
                    </div>
                </div>
                {{-- <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span class="whitespace-nowrap">Report
                            a
                            problem</span></a>
                </div> --}}
            </div>
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6">
                    <img src="{{ asset('icons/ic_male_student.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-md lg:whitespace-nowrap">Murid Laki-laki</span>
                        <h1 class="font-bold text-2xl">{{ $maleStudents }}</h1>
                    </div>
                </div>
                {{-- <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span class="whitespace-nowrap">Report
                            a
                            problem</span></a>
                </div> --}}
            </div>
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6">
                    <img src="{{ asset('icons/ic_female_student.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-md lg:whitespace-nowrap">Murid Perempuan</span>
                        <h1 class="font-bold text-2xl">{{ $femaleStudents }}</h1>
                    </div>
                </div>
                {{-- <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span class="whitespace-nowrap">Report
                            a
                            problem</span></a>
                </div> --}}
            </div>
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6">
                    <img src="{{ asset('icons/ic_total_teachers.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-md lg:whitespace-nowrap">Jumlah Guru</span>
                        <h1 class="font-bold text-2xl">{{ $totalTeachers }}</h1>
                    </div>
                </div>
                {{-- <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span
                            class="whitespace-nowrap">Report
                            a
                            problem</span></a>
                </div> --}}
            </div>
        </div>

        <div class="flex lg:flex-row flex-col-reverse mt-4 lg:mt-8 gap-y-4 lg:gap-x-8 mx-4 lg:mx-0">
            <div
                class="flex  flex-col gap-y-2 bg-gradient-to-r from-accent-1 to-accent-2 p-6 rounded-lg shadow-button text-white">
                <img src="{{ asset('icons/ic_docs.svg') }}" class="w-24" alt="">
                <h1 class="font-semibold text-2xl">Selamat Datang</h1>
                <span>E-Assessment dapat menyelenggarakan ujian dengan aman dan nyaman. Buatlah sistem ujian sekolah anda dengan menggunakan E-Assessment.</span>

                {{-- <a href="" class="flex gap-x-1 mt-1 items-center text-end font-semibold">
                    <img src="{{ asset('icons/ic_more.svg') }}" class="h-5" alt="">
                    <span class="text-sm">Click Here</span>
                </a> --}}
            </div>

            <div class="w-full bg-white rounded-lg shadow-button">
                <h1 class="border-b px-5 py-4 flex justify-between">
                    <div class="flex gap-x-2">
                        <img src="{{ asset('icons/ic_calendar.svg') }}" alt="">
                        <span class="font-bold">Kalender</span>
                    </div>
                    <span class="font-bold" id="Calendar"></span>
                </h1>

                <div class="p-4">
                    <div class="grid grid-cols-7 gap-2 text-center">
                        <!-- Days of the week -->
                        @foreach (['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                            <div class="font-bold">{{ $day }}</div>
                        @endforeach

                        <!-- Empty cells for days of the previous month -->
                        @for ($i = 0; $i < $firstDayOfMonth; $i++)
                            <div></div>
                        @endfor

                        <!-- Days of the current month -->
                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            <div
                                class="p-2 rounded {{ $day == $currentDay ? 'bg-accent-1 text-white font-bold' : 'bg-gray-100' }}">
                                {{ $day }}
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

        </div>

        <div class="flex flex-col lg:flex-row mt-4 lg:mt-8 lg:gap-x-8 gap-y-4">
            <div class="flex flex-col flex-grow bg-white rounded-lg shadow-button mx-4 lg:mx-0">
                <div class="flex justify-between pt-6 pb-2 px-6">
                    <div>
                        <!-- table title -->
                        <span class="flex gap-x-2">
                            <img src="{{ asset('icons/ic_active_teachers.svg') }}" class="w-6 h-6">
                            <h1 class="font-bold">Guru Aktif</h1>
                        </span>
                    </div>

                    <span class="flex items-center text-sm gap-x-1 mt-1">
                        Jumlah {{ $totalTeachers }} Guru Aktif</span>
                </div>
                <div class="overflow-x-auto pb-2 rounded-b-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-white">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                    Nama
                                </th>

                            </tr>
                        </thead>
                        <tbody class="bg-white flex flex-col pb-4 pt-4 gap-y-4">
                            @foreach ($dataTeachers as $index => $dataTeacher)
                                <tr class=" px-6">
                                    <td class="flex  items-center">
                                        <img src="{{ asset('images/img_dashboard_admin.png') }}" class="w-4 h-4 mr-2"
                                            alt="">
                                        <span class="text-sm">{{ $dataTeacher->user->name }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex flex-col bg-white rounded-lg shadow-button flex-grow mx-4 lg:mx-0">
                <div class="pb-6 pt-6 px-6 flex gap-x-2 items-center">
                    <img src="{{asset('icons/ic_assessment.svg')}}" class="filter-accent-1 w-5 h-5">
                    <h1 class="font-bold">Recently Added Tests</h1>
                </div>
                <div class="border-t py-6 ">
                    <div class="flex flex-col gap-y-4">
                        @foreach ($exams as $exam)
                            <div class="border-b pb-3">
                                <div class="flex lg:justify-between gap-x-4 px-6">
                                    <div
                                        class="bg-gradient-to-r from-accent-1 to-accent-2 py-2 px-8 rounded-xl -mt-1 text-white font-bold text-xs">
                                        {{ $exam->created_at->format('m/d') }}
                                    </div>
                                    <span>{{ $exam->subject->name }}</span>
                                    <span>{{ $exam->examType->name }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    @endif

    @if (auth()->user()->hasPermissionTo('teacher-access'))
        <!-- Admin Dashboard -->
        <div class="grid grid-cols-2 lg:grid-cols-4 mx-4 mt-4 lg:mx-0 lg:mt-8 gap-4 lg:gap-x-8">
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6 overflow-hidden">
                    <img src="{{ asset('icons/ic_total_students.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-md lg:whitespace-nowrap">Jumlah Students</span>
                        <h1 class="font-bold text-2xl">{{ $totalStudents }}</h1>
                    </div>
                </div>
                {{-- <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span
                            class="whitespace-nowrap">Report
                            a
                            problem</span></a>
                </div> --}}
            </div>
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6 overflow-hidden">
                    <img src="{{ asset('icons/ic_male_student.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-md lg:whitespace-nowrap">Murid Laki-laki</span>
                        <h1 class="font-bold text-2xl">{{ $maleStudents }}</h1>
                    </div>
                </div>
                {{-- <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span
                            class="whitespace-nowrap">Report
                            a
                            problem</span></a>
                </div> --}}
            </div>
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6 overflow-hidden">
                    <img src="{{ asset('icons/ic_female_student.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-md lg:whitespace-nowrap">Murid Perempuan</span>
                        <h1 class="font-bold text-2xl">{{ $femaleStudents }}</h1>
                    </div>
                </div>
                {{-- <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span
                            class="whitespace-nowrap">Report
                            a
                            problem</span></a>
                </div> --}}
            </div>
            <div class="flex flex-col bg-white shadow-button rounded-lg  ">
                <div class="flex justify-between p-6 overflow-hidden">
                    <img src="{{ asset('icons/ic_total_teachers.svg') }}" class="w-16" alt="">
                    <div class="flex-grow w-24"></div>
                    <div class="flex flex-col text-end">
                        <span class="text-md lg:whitespace-nowrap">Jumlah Guru</span>
                        <h1 class="font-bold text-2xl">{{ $totalTeachers }}</h1>
                    </div>
                </div>
                {{-- <div class="border-t px-6 py-3">
                    <a href="#" class="flex gap-x-1 text-xs text-textColorDisabled"><img
                            src="{{ asset('icons/ic_small_report.svg') }}" alt=""> <span
                            class="whitespace-nowrap">Report
                            a
                            problem</span></a>
                </div> --}}
            </div>
        </div>

        <div class="flex flex-col lg:flex-row lg:gap-8  mx-4 lg:mx-0">
            <div class="lg:mt-8 mt-4 lg:w-1/3 bg-white rounded-lg shadow-button shrink-0">
                <h1 class="border-b px-5 py-2">Mata Pelajaran</h1>
                <div class="flex flex-wrap gap-3 text-white p-4">
                    @foreach ($subjects as $subject)
                        <button class="bg-accent-1 hover:bg-accent-2 p-2 rounded-xl">{{ $subject->name }}</button>
                    @endforeach
                </div>
            </div>
            <div class="lg:mt-8 mt-4 w-full bg-white rounded-lg shadow-button">
                <h1 class="border-b px-5 py-2">Mata Pelajaran</h1>
                <div class="flex flex-wrap gap-3 text-white p-4 ">
                    @foreach ($subjects as $subject)
                        <button class="bg-accent-1 hover:bg-accent-2 p-2 rounded-xl">{{ $subject->name }}</button>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="flex flex-col lg:gap-8 lg:flex-row  mx-4 lg:mx-0">
            <div class="lg:mt-8 mt-4 w-full lg:w-1/2 bg-white rounded-lg shadow-button">
                <h1 class="border-b px-5 py-2">Kelas</h1>
                <div class="grid grid-cols-3 gap-4 p-4 select-none">
                    @foreach ($classrooms as $index => $classroom)
                        <div class="p-4 rounded-xl {{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-gray-100' }}">
                            Class {{ $classroom->name }}
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:mt-8 mt-4 w-full lg:w-1/2 bg-white rounded-lg shadow-button">
                <h1 class="border-b px-5 py-2 flex justify-between">
                    <span>Kalender</span>
                    <span id="Calendar"></span>
                </h1>

                <div class="p-4">
                    <div class="grid grid-cols-7 gap-2 text-center select-none">
                        <!-- Days of the week -->
                        @foreach (['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                            <div class="font-bold">{{ $day }}</div>
                        @endforeach

                        <!-- Empty cells for days of the previous month -->
                        @for ($i = 0; $i < $firstDayOfMonth; $i++)
                            <div></div>
                        @endfor

                        <!-- Days of the current month -->
                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            <div
                                class="p-2 rounded {{ $day == $currentDay ? 'bg-accent-1 text-white font-bold' : 'bg-gray-100' }}">
                                {{ $day }}
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->hasPermissionTo('student-access'))
    <!-- Dashboard Siswa -->
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
                    <h1 class="text-accent-1 text-3xl font-semibold">Ujian</h1>
                </div>
                <span class="text-sm lg:text-lg lg:w-3/4">Penilaian online yang disusun dan dibuat oleh sekolah dan guru Anda. Lihat apakah ada penilaian yang tersedia
                    untuk Anda dengan mengklik tautan di atas.</span>
            </div>
            <a href="{{ route('students.exams.index') }}"
                class="flex gap-x-1 place-content-end text-accent-1 font-semibold mt-2"><img
                    src="{{ asset('icons/ic_more2.svg') }}" alt=""> Klik di Sini</a>
        </div>
        <div class="bg-white rounded-md shadow-button p-4 lg:p-8 flex flex-col justify-between">
            <div class="flex flex-col gap-y-2">
                <div class="flex lg:flex-col gap-x-3">
                    <img src="{{ asset('icons/ic_big_results.svg') }}" class="lg:w-20 mb-2 lg:h-20 w-10 h-10"
                        alt="">
                    <h1 class="text-accent-1 text-3xl font-semibold">Laporan</h1>
                </div>
                <span class="text-sm lg:text-lg lg:w-3/4">Semua penilaian Anda tercatat dalam basis data kami. Anda dapat memeriksa, meninjau, atau mempelajari tes lama Anda dengan jawaban yang benar diberikan.</span>
            </div>
            <a href="{{ route('students.reports.index') }}"
                class="flex gap-x-1 place-content-end text-accent-1 font-semibold mt-2"><img
                    src="{{ asset('icons/ic_more2.svg') }}" alt=""> Klik di Sini</a>
        </div>
        <div class="bg-white rounded-md shadow-button p-4 lg:p-8 flex flex-col justify-between">
            <div class="flex flex-col gap-y-2">
                <div class="flex lg:flex-col gap-x-3">
                    <img src="{{ asset('icons/ic_big_profile.svg') }}" class="lg:w-20 mb-2 lg:h-20 w-10 h-10"
                        alt="">
                    <h1 class="text-accent-1 text-3xl font-semibold">Profil Saya</h1>
                </div>
                <span class="text-sm lg:text-lg lg:w-3/4">Periksa identitas Anda, semua data Anda disimpan secara pribadi dan aman dalam basis data sekolah.</span>
            </div>
            <a href="{{ route('profile') }}"
                class="flex gap-x-1 place-content-end text-accent-1 font-semibold mt-2"><img
                    src="{{ asset('icons/ic_more2.svg') }}" alt=""> Klik di Sini</a>
        </div>
        <div
            class="bg-gradient-to-r from-accent-1 to-accent-2 text-white rounded-md shadow-button p-4 lg:p-8 flex flex-col justify-between">
            <div class="flex flex-col gap-y-2">
                <div class="flex lg:flex-col gap-x-3">
                    <img src="{{ asset('icons/ic_big_docs.svg') }}" class="lg:w-20 mb-2 lg:h-20 w-10 h-10"
                        alt="">
                    <h1 class="text-white  text-3xl font-semibold">Selamat Datang</h1>
                </div>
                <span class="text-sm lg:text-lg lg:w-3/4">Pelajari dengan benar cara menggunakan situs web e-assessment, dasar-dasarnya dan aturan-aturannya. Pahami agar terhindar dari kesalahan dan masalah.</span>
            </div>
            <a href="" class="flex gap-x-1 place-content-end text-white font-semibold mt-2"><img
                    {{-- src="{{ asset('icons/ic_more.svg') }}" alt=""> Klik di Sini</a> --}}
        </div>
        <!-- Ulangi struktur yang sama untuk kartu lainnya -->
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
