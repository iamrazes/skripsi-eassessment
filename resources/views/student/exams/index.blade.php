@extends('layouts.app')

@section('title')
    <title>Exams - {{ config('app.name') }}</title>
@endsection

@section('content')

    @if (session('error'))
        <div id="error-notification" class="notification bg-red-500 text-white p-3 rounded shadow">
            {{ session('error') }}
        </div>
    @endif

    <div class="mt-4 lg:mt-8 mx-4 lg:mx-0 flex flex-col bg-white rounded-lg shadow-button">
        <div class="pt-4 pb-4 lg:pb-6">

            <h1 class="border-b text-lg font-semibold px-4 pb-3 lg:px-6 flex gap-x-2 lg:gap-x-3"> <img
                    src="{{ asset('icons/ic_assessment3.svg') }}" alt="">Ujian Tersedia</h1>

            <div class="flex flex-col">
                @if ($exams->isEmpty())
                    <div class="flex pt-40 pb-36 justify-center">
                        <p>Tidak ada ujian tersedua.</p>
                    </div>
                @else
                    <div class="grid lg:grid-cols-3 gap-4 pt-4 lg:pt-6 lg:gap-6 px-4 lg:px-6">

                        @foreach ($exams as $exam)
                            <div class="bg-white p-4 rounded-lg flex flex-col shadow-button">
                                <div class="flex gap-4">
                                    <img src="{{ asset('icons/ic_assessment1.svg') }}" alt="">
                                    <div class="flex flex-col">
                                        <h1 class="font-semibold line-clamp-1 lg:text-lg uppercase">
                                            {{ $exam->examType->name }}</h1>
                                        <h1 class=" line-clamp-2 text-sm lg:text-base">{{ $exam->subject->name }}</h1>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-y-2 mt-2 border-t pt-2">
                                    <div class="mx-2.5 flex flex-col text-sm lg:text-base">
                                        <label class="flex justify-between">Ditujukan Kepada: <span>Kelas
                                                @foreach ($exam->classrooms as $classroom)
                                                    {{ $classroom->name }}@if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </span></label>
                                        <label class="flex justify-between">Jumlah Pertanyaan:
                                            <span>{{ $exam->total_questions }} Butir</span></label>
                                        <label class="flex justify-between">Durasi:
                                            <span>{{ $exam->duration }} Menit</span></label>
                                        <label class="flex justify-between">Tanggal:
                                            <span class="text-end">{{ $exam->date->format('d/m/Y') }}<br>
                                                ({{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }})
                                            </span></label>
                                    </div>
                                    <a href="{{ route('students.exams.show', $exam->id) }}"
                                        class="bg-accent-1 hover:bg-gradient-to-r from-accent-1 to-accent-2 rounded-3xl text-white font-semibold text-center mt-1 lg:mt-3 py-2 mx-2 lg:mx-2 ">Lanjutkan</a>
                                </div>
                            </div>
                        @endforeach
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show success notification if success message is present
            @if (session('success'))
                const successNotification = document.getElementById('success-notification');
                successNotification.style.display = 'block';
                setTimeout(() => {
                    successNotification.style.display = 'none';
                }, 3000);
            @endif

            // Show error notification if error message is present
            @if (session('error'))
                const errorNotification = document.getElementById('error-notification');
                errorNotification.style.display = 'block';
                setTimeout(() => {
                    errorNotification.style.display = 'none';
                }, 3000);
            @endif
        });
    </script>
@endsection
