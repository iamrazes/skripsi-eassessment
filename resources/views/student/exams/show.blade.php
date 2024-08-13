@extends('layouts.bridge')

@section('content')
    <div id="notification" class="notification">
        {{ session('success') }}
    </div>
    <div class="container justify-center items-center mx-auto mt-8 lg:mt-20">
        <div class="bg-white rounded-3xl border-2 border-accent-1 shadow-button mx-4 my-4 p-4 pt-10 pb-20">
            <div class="justify-center flex filter-red">
                <img src="{{ asset('icons/ic_alert.svg') }}" class="lg:w-40 lg:h-40 w-20 h-20">
            </div>
            <div class="items-center flex flex-col text-center overflow-hidden">
                <h1 class="lg:text-4xl text-xl filter-red">Perhatian!</h1>
                <p class="mt-2 text-sm lg:text-base">Anda akan mengikuti ujian "<strong>{{ $exam->title }}</strong>"
                </p>
                <p class="text-xs sm:text-sm lg:text-base lg:w-1/2 whitespace-wrap my-2">
                    Sebelum Anda memulai ujian, pastikan Anda telah membaca semua instruksi dengan cermat. Pastikan Anda
                    memiliki koneksi internet yang stabil dan lingkungan yang tenang untuk fokus. Ujian ini dibatasi waktu, dan setelah Anda memulai, waktu tidak dapat dihentikan. Pastikan untuk menyimpan jawaban Anda secara berkala. Jika Anda mengalami masalah selama ujian, hubungi pengajar Anda segera. Semoga sukses!
                </p>

            </div>
            <div
                class="flex flex-col bg-gray-100 mx-auto max-w-full px-3 py-2 lg:px-3 rounded-xl mt-3 text-sm lg:text-base lg:w-1/2">
                <p class="flex justify-between"><span>Mata Pelajaran:</span> {{ $exam->subject->name }}</p>
                <p class="flex justify-between"><span>Jenis:</span> {{ $exam->examType->name }}</p>
                <p class="flex justify-between"><span>Tanggal:</span> {{ $exam->date->format('F, d-m-Y') }}</p>
                <p class="flex justify-between"><span>Mulai:</span> <span
                        class="text-end">{{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }}
                    </span></p>
                <p class="flex justify-between"><span>Durasi:</span> {{ $exam->duration }} menit</p>
            </div>
            <div class="text-center mt-3 flex flex-col lg:w-1/2 lg:mx-auto">

                <div id="notification" class="notification">
                    {{ session('success') }}
                </div>


                @if ($isExamAvailable)
                    <a href="{{ route('students.exams.show-question', ['exam' => $exam->id, 'question' => 1]) }}"
                        class="bg-accent-1 hover:bg-gradient-to-r from-accent-1 to-accent-2 py-2 my-2 text-white font-semibold rounded-3xl">
                        Mulai Ujian
                    </a>
                    <p class="text-sm lg:text-base">*Ujian tersedia, klik tombol untuk melanjutkan</p>
                @else
                    <a class="bg-gray-100 py-2 my-2 text-gray-400 rounded-3xl">Tidak Tersedia</a>
                    <p class="text-sm lg:text-base">*Tautan akan tersedia saat waktunya tiba</p>
                @endif

            </div>
        </div>
        <div class="flex mx-4 ">
            <a href="{{ route('students.exams.index') }}" class="text-accent-1 hover:text-accent-2 flex gapx-2"><img
                    src="{{ asset('icons/ic_left2.svg') }}" alt="">Kembali</a>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tampilkan notifikasi jika pesan sukses ada
            @if (session('success'))
                const notification = document.getElementById('notification');
                notification.style.display = 'block';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 3000);
            @endif
        });
    </script>
@endsection
