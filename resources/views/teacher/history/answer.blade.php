@extends('layouts.app')

@section('content')
    <div class="container mx-auto">

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Student: {{ $studentReport->student->name }}</h3>
                <!-- Display other student information here if needed -->
            </div>
            <div class="border-t border-gray-200">
                <!-- Display student answer details -->
                <div class="px-4 py-5 sm:px-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Score</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $studentReport->score }}</dd>
                        </div>
                        <!-- Add more details as needed -->
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection
