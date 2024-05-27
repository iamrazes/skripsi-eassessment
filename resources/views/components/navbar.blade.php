<nav class="flex justify-between">
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
            <h6 class="mb-0 font-bold capitalize">Dashboard</h6>
        </div>
    </nav>

    <nav class="flex gap-x-6">
        <!-- close buttton -->
        <button id="closeSidebar" class="hidden lg:hidden">
            <img src="{{ asset('icons/ic_bars.svg') }}" alt="Close Sidebar">
        </button>
        <a>
            <img src="{{ asset('icons/ic_notification.svg') }}" alt="">
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            this.closest('form').submit();">
                <img src="{{ asset('icons/ic_exit.svg') }}" alt="Logout" class="transition duration-300 ease-in-out transform hover:scale-110">
            </a>
        </form>
    </nav>
</nav>
