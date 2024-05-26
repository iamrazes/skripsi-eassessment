<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>E-Assessment</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('icons/logo.svg') }}">
</head>

<body class="bg-[#F5F7F8] text-textColor antialiased flex">

    <x-sidebar />


    <main class="flex-grow flex flex-col min-h-screen my-4 mx-8 lg:mx-0 lg:mr-8 lg:my-8 ">

        <x-navbar />



        <x-footer />
    </main>

    @js('js/sidebar.js')
    @js('js/expand.js')
</body>

</html>
