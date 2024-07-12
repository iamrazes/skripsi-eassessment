<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $exam->title }} - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('icons/logo.svg') }}">
</head>

<body class="bg-[#F5F7F8] text-textColor antialiased flex flex-col">

    @yield('content')

    @yield('script')
</body>
</html>
