<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Assessment</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('icons/logo.svg') }}">
    <style>

    </style>
</head>

<body class="bg-[#BAE2FF] text-textColor antialiased flex items-center justify-center min-h-screen">
    <div class="relative flex items-center justify-center">
        <!-- Main content with section 1 and section 2 -->
        <div class="flex rounded-xl overflow-hidden mb-8 relative z-10 shadow">
            @auth
                <!-- Show Dashboard button if user is logged in -->
                <div class="bg-white  flex flex-col px-20 py-28">
                    <div class="flex flex-col mb-2 items-center">
                        <img src="{{ asset('icons/logo_eassessment.svg') }}" style="width: 150px; height: 150px;"
                            alt="">
                        <h1 class="text-xl mt-2 bg-gradient-to-r from-accent-1 to-accent-2 bg-clip-text text-transparent">
                            E-Assessment</h1>

                            <span class="text-center">Welcome back, <span class="font-semibold text-accent-1">{{ auth()->user()->name }}</span></span>
                    </div>
                    <a href="{{ route('dashboard') }}"
                        class="uppercase text-center bg-accent-2 hover:transition hover:scale-125 min-w-full text-white font-semibold rounded-full py-3 px-24 my-8 ">
                        Dashboard
                    </a>
                </div>
            @else
                <!-- section 1 -->
                <div class="flex flex-col items-center rounded-l-xl bg-white py-28 lg:px-24 px-8">
                    <div class="flex flex-col mb-2 items-center">
                        <img src="{{ asset('icons/logo_eassessment.svg') }}" style="width: 150px; height: 150px;"
                            alt="">
                        <h1 class="text-xl mt-2 bg-gradient-to-r from-accent-1 to-accent-2 bg-clip-text text-transparent">
                            E-Assessment</h1>

                    </div>

                    <!-- Show login form if user is not logged in -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="flex flex-col gap-y-1">
                            @error('username')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                            @error('password')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                            <label for="" class="text-xs mt-2">Username:</label>
                            <div class="flex bg-[#F2F2F2] rounded-lg">
                                <img src="{{ asset('icons/ic_id.svg') }}" class="px-4" alt="">
                                <input name="username" type="text"
                                    class="bg-[#F2F2F2] rounded-r-lg min-w-max px-4 py-3 text-xs w-60 border-0">
                            </div>
                            <label for="" class="text-xs mt-2">Password:</label>
                            <div class="flex bg-[#F2F2F2] rounded-lg">
                                <img src="{{ asset('icons/ic_password.svg') }}" class="px-4" alt="">
                                <input name="password" type="password"
                                    class="bg-[#F2F2F2] rounded-r-lg min-w-max px-4 py-3 text-xs w-60 border-0">
                            </div>
                        </div>
                        <button type="submit"
                            class="uppercase text-center bg-accent-2 min-w-full text-white font-semibold rounded-full py-3 my-8">
                            Sign In
                        </button>
                    </form>
                </div>
                <!-- section 2 -->
                <div
                    class="flex-grow relative bg-gradient-to-tr from-accent-1 to-accent-2 rounded-r-xl p-8 hidden lg:flex items-center justify-center">
                    <!-- Content for section 2 can go here -->
                    <div class="bg-[#97DCF7] px-36 py-52 mx-20 rounded-2xl relative overflow-hidden">
                    </div>
                    <img src="{{ asset('images/login_img.png') }}" class="absolute inset-0 w-full h-full object-contain"
                        alt="">
                </div>

            @endauth
        </div>

        <!-- Top div -->
        <div
            class="absolute top-0 left-0 transform -translate-x-1/2 -translate-y-1/2 w-24 h-24 bg-accent-2 rounded-full z-0">
        </div>

        <!-- Bottom div -->
        <div
            class="absolute bottom-0 right-0 transform translate-x-1/2 translate-y-2 w-24 h-24 bg-white rounded-full z-0">
        </div>
    </div>
</body>

</html>
