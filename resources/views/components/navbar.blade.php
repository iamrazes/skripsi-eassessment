<nav class="flex justify-between m-4 lg:m-0 grow-0 shrink-0">
    <nav class="flex ">
        <button class="block lg:hidden" id="sidebarButton" s>
            <img src="{{ asset('icons/ic_bars.svg') }}" alt="">
        </button>
        <!-- breadcrumb -->
        <div class="ml-6 lg:ml-0">
            <div class="hidden lg:block">
                <ol class="flex flex-wrap mr-12 bg-transparent rounded-lg sm:mr-16 ">
                    <li class="text-xs lg:text-sm leading-normal">
                        <a class="opacity-50 ">Pages</a>
                    </li>
                    <li class="text-xs lg:text-sm pl-2 capitalize leading-normal before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                        aria-current="page">Dashboard</li>
                </ol>
            </div>
            <h6 class="mb-0 font-bold capitalize hidden lg:block">
                @if (Route::is('dashboard'))
                    Dashboard
                @elseif (Route::is('profile'))
                    Profile
                @elseif (Route::is('students.exams.index'))
                    Exams
                @elseif (Route::is('students.reports*'))
                    Reports
                @elseif (Route::is('teacher.exams*'))
                    Exams
                @elseif (Route::is('teacher.history*'))
                    Exams History
                @elseif (Route::is('admin*'))
                    Admin Panel
                @else
                    Other
                @endif
            </h6>


        </div>
    </nav>

    <nav class="flex gap-x-6">

        <a href="{{ route('profile') }}"
            class="font-bold text-accent-1 line-clamp-1 hover:text-accent-2 transition ease-in-out uppercase">{{ auth()->user()->name }}</a>

        {{-- <a>
            <img src="{{ asset('icons/ic_notification.svg') }}" class="filter-gray" alt="">
        </a> --}}

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            this.closest('form').submit();"
                class="">
                <img src="{{ asset('icons/ic_exit.svg') }}" alt="Logout"
                    class="transition duration-300 ease-in-out  transform hover:scale-110">
            </a>
        </form>
        <!-- close buttton -->
        <button id="closeSidebar" class="hidden lg:hidden">
            <img src="{{ asset('icons/ic_bars.svg') }}" alt="Close Sidebar">
        </button>
    </nav>
</nav>
