@extends('layouts.dashboard')

@section('title')
<title>Examine Assessment - {{ config('app.name') }}</title>
@endsection

@section('content')


        <!-- Content Here -->
        <div
            class="flex mt-8 bg-gradient-to-r from-accent-1 to-accent-2 shadow-button py-4 px-5 text-center rounded-lg text-white font-medium gap-x-2 text-2xl">
            <img src="{{asset('icons/ic_assessment-examine.svg')}}" alt="" class="filter-white">
            <span>Examine Assessment</span>
        </div>

        <div class="overflow-hidden bg-white rounded-lg mt-8 shadow-button">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-white">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-md font-medium uppercase tracking-wider">Title
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-md font-medium uppercase tracking-wider">Subject
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-md font-medium uppercase tracking-wider">Date
                            Assigned</th>
                        <th scope="col" class="px-6 py-3 text-left text-md font-medium uppercase tracking-wider">Class
                            Assigned</th>
                        <th scope="col" class="px-6 py-3 text-left text-md font-medium uppercase tracking-wider">Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-md font-medium uppercase tracking-wider">Option
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-gray-200">
                    <tr class="bg-white divide-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{asset('icons/ic_stars.svg"')}} class="h-5 w-5 inline-block mr-2" alt="">
                            Title
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">Subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">Date Assigned</td>
                        <td class="px-6 py-4 whitespace-nowrap">Class Assigned</td>
                        <td class="px-6 py-4 whitespace-nowrap">Status</td>
                        <td class="px-6 py-4 whitespace-nowrap text-accent-1 font-bold"><a href="/src/examine-assessment-1.html">Examine</a></td>
                    </tr>
                    <tr class="bg-white divide-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{asset('icons/ic_stars.svg"')}} class="h-5 w-5 inline-block mr-2" alt="">
                            Title
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">Subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">Date Assigned</td>
                        <td class="px-6 py-4 whitespace-nowrap">Class Assigned</td>
                        <td class="px-6 py-4 whitespace-nowrap">Status</td>
                        <td class="px-6 py-4 whitespace-nowrap text-accent-1 font-bold"><a href="/src/examine-assessment-1.html">Examine</a></td>
                    </tr>
                    <tr class="bg-white divide-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{asset('icons/ic_stars.svg"')}} class="h-5 w-5 inline-block mr-2" alt="">
                            Title
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">Subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">Date Assigned</td>
                        <td class="px-6 py-4 whitespace-nowrap">Class Assigned</td>
                        <td class="px-6 py-4 whitespace-nowrap">Status</td>
                        <td class="px-6 py-4 whitespace-nowrap text-accent-1 font-bold"><a href="/src/examine-assessment-1.html">Examine</a></td>
                    </tr>
                    <tr class="bg-white divide-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{asset('icons/ic_stars.svg"')}} class="h-5 w-5 inline-block mr-2" alt="">
                            Title
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">Subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">Date Assigned</td>
                        <td class="px-6 py-4 whitespace-nowrap">Class Assigned</td>
                        <td class="px-6 py-4 whitespace-nowrap">Status</td>
                        <td class="px-6 py-4 whitespace-nowrap text-accent-1 font-bold"><a href="/src/examine-assessment-1.html">Examine</a></td>
                    </tr>
                    <tr class="bg-white divide-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{asset('icons/ic_stars.svg"')}} class="h-5 w-5 inline-block mr-2" alt="">
                            Title
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">Subject</td>
                        <td class="px-6 py-4 whitespace-nowrap">Date Assigned</td>
                        <td class="px-6 py-4 whitespace-nowrap">Class Assigned</td>
                        <td class="px-6 py-4 whitespace-nowrap">Status</td>
                        <td class="px-6 py-4 whitespace-nowrap text-accent-1 font-bold"><a href="/src/examine-assessment-1.html">Examine</a></td>
                    </tr>
                    <!-- Repeat the same structure for other rows -->
                </tbody>
            </table>
        </div>

        <div class="flex flex-col gap-y-2 justify-center text-center items-center my-16 text-gray-400">
            <h1 class="text-2xl font-bold">You Don't Have Any <br>Assessment To Be Examined</h1>
            <div>
            <a href="/src/create-assessments.html" class="font-semibold underline text-xs">Create Assessment</a>
            <span class="text-xs">or</span>
            <a href="/src/review-assessments.html" class="font-semibold underline text-xs">Review Assessment</a>
            </div>
        </div>

@endsection

@section('script')

@endsection
