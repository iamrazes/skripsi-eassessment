@extends('layouts.bridge')

@section('content')

<div class="container justify-center items-center mx-auto mt-8 lg:mt-20">
    <div class="bg-white rounded-3xl border-2 border-accent-1 shadow-button mx-4 my-4 p-4 pt-10 pb-20">
        <div class="justify-center flex filter-red">
            <img src="{{ asset('icons/ic_alert.svg') }}" class="lg:w-40 lg:h-40 w-20 h-20">
        </div>
        <div class="items-center flex flex-col text-center overflow-hidden">
            <h1 class="lg:text-4xl text-xl filter-red">Attentions!</h1>
            <p class="mt-2 text-sm lg:text-base">You are have attended exam "<strong>{{ $exam->title }}</strong>"</p>
            <p class="text-xs sm:text-sm lg:text-base lg:w-1/2 whitespace-wrap my-2">

            </p>

        </div>
        <div
            class="flex flex-col bg-gray-100 mx-auto max-w-full px-3 py-2 lg:px-3 rounded-xl mt-3 text-sm lg:text-base lg:w-1/2">
            <p class="flex justify-between"><span>Subject:</span> {{ $exam->subject->name }}</p>
            <p class="flex justify-between"><span>Type:</span> {{ $exam->examType->name }}</p>
            <p class="flex justify-between"><span>Date:</span> {{ $exam->date->format('F, d-m-Y') }}</p>
            <p class="flex justify-between"><span>Start:</span> <span
                    class="text-end">{{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }}
                </span></p>
            <p class="flex justify-between"><span>Duration:</span> {{ $exam->duration }} minutes</p>
        </div>
        <div class="text-center mt-3 flex flex-col lg:w-1/2 lg:mx-auto">

        </div>
    </div>

</div>
@endsection
