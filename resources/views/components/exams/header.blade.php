
<div
class="flex justify-between bg-gradient-to-r from-accent-1 to-accent-2 lg:pt-8 pb-20 pt-5 px-3 lg:px-16 flex-grow text-white">
<div>
    <h1 class="font-bold lg:text-2xl uppercase">{{ $exam->examType->name }}</h1>
    <h2 class="font-semibold">Mata Pelajaran: {{ $exam->subject->name }}</h2>
    <h2 class="font-semibold">Tanggal: {{ $exam->date->format('F, d-m-Y') }}</h2>
</div>
<div class="flex flex-col text-end">
    <span class="flex items-center place-content-end gap-x-2">
        <span id="countdown" class="lg:text-4xl text-2xl gap-x-2"></span>
        <img src="{{ asset('icons/ic_timer.svg') }}" alt="" class="h-8 lg:h-12">
    </span>
    <h2 class="font-semibold">Durasi: {{ $exam->duration }} minutes</h2>
    <h2 class="font-semibold">Jadwal: {{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }} - Selesai
    </h2>
</div>
</div>
