<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Assessment</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('icons/logo.svg') }}">
</head>

<body class="bg-[#BAE2FF] text-textColor antialiased flex items-center justify-center min-h-screen">
    <div class="relative flex items-center justify-center">
        <!-- Main content with section 1 and section 2 -->
        <div class="flex rounded-xl overflow-hidden mb-8 relative z-10 shadow">
            <!-- section 1 -->
            <div class="flex flex-col items-center rounded-l-xl bg-white py-28 lg:px-24 px-8">
                <img src="{{ asset('icons/logo_eassessment.svg') }}" style="width: 150px; height: 150px;" class=" mb-8"
                    alt="">

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="flex flex-col gap-y-1 ">
                        @error('user_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                        @error('password')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                        <label for="" class="text-xs mt-2">Student/Teacher ID:</label>
                        <div class="flex bg-[#F2F2F2] rounded-lg">
                            <img src="{{ asset('icons/ic_id.svg') }}" class="px-4" alt="">
                            <input name="user_id" type="text"
                                class="bg-[#F2F2F2] rounded-r-lg min-w-max px-4 py-3 text-xs w-60 border-0">
                        </div>
                        <label for="" class="text-xs mt-2">Password:</label>
                        <div class="flex bg-[#F2F2F2] rounded-lg">
                            <img src="{{ asset('icons/ic_password.svg') }}" class="px-4" alt="">
                            <input name="password" type="password"
                                class="bg-[#F2F2F2] rounded-r-lg min-w-max px-4 py-3 text-xs w-60 border-0">
                        </div>
                    </div>
                    <button href="{{ __('Log in') }}"
                        class="uppercase text-center bg-accent-2 min-w-full text-white font-semibold rounded-full py-3 my-8">Sign
                        In</button>
            </div>
            </form>
            <!-- section 2 -->
            <div
                class="flex-grow relative bg-gradient-to-tr from-accent-1 to-accent-2 rounded-r-xl p-8 hidden lg:flex items-center justify-center">
                <!-- Content for section 2 can go here -->
                <div class="bg-[#97DCF7] px-36 py-52 mx-20 rounded-2xl relative overflow-hidden">
                </div>
                <img src="{{ asset('images/login_img.png') }}" class="absolute inset-0 w-full h-full object-contain"
                    alt="">
            </div>
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
