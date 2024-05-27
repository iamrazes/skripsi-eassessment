
<aside id="sidebar" class="lg:block hidden bg-white w-80 min-h-screen rounded-xl shadow-md pb-8 lg:my-8 lg:mx-8 flex-shrink-0">
    <!-- Title -->
    <div class="px-4 pt-6 text-accent-1">
        <h1 class="flex justify-center gap-x-2">
            <img src="{{asset('icons/ic_sidebar_logo.svg')}}" alt="">
            <span>E-Assessment</span>
        </h1>
        <div class="mt-4 h-[1px] bg-gradient-to-r from-white via-accent-1 to-white">
        </div>
    </div>
    <!-- Items -->
    <div class="py-3 px-5 space-y-5">
        <!-- Main -->
        <a href="{{route('dashboard')}}"
            class="px-4 py-3 flex items-center space-x-4 rounded-lg shadow-button group bg-white hover:bg-[#ecf7ff] transition ease-in-out {{ request()->routeIs('dashboard') ? 'text-white bg-gradient-to-r from-accent-1 to-accent-2' : '' }}">
            <img src="{{asset('icons/ic_dashboard.svg')}}" class="{{ request()->routeIs('dashboard') ? 'filter-white' : '' }}">
            <span class="-mr-1 font-semibold">Dashboard</span>
        </a>
        <a href="{{route('profile')}}"
            class="px-4 py-3 flex items-center space-x-4 rounded-lg shadow-button group bg-white hover:bg-[#ecf7ff] transition ease-in-out {{ request()->routeIs('profile') ? 'text-white bg-gradient-to-r from-accent-1 to-accent-2' : '' }}">
            <img src="{{asset('icons/ic_profile.svg')}}" class="{{ request()->routeIs('profile') ? 'filter-white' : '' }}">
            <span class="-mr-1 font-semibold">My Profile</span>
        </a>

        <div class="font-bold pt-3">STUDENT SECTION</div>
        <a href="{{route('students.assessments')}}"
            class="px-4 py-3 flex items-center space-x-4 rounded-lg shadow-button group bg-white hover:bg-[#ecf7ff] transition ease-in-out {{ request()->routeIs('students.assessments') ? 'text-white bg-gradient-to-r from-accent-1 to-accent-2' : '' }}">
            <img src="{{asset('icons/ic_student_assessment.svg')}}" class="{{ request()->routeIs('students.assessments') ? 'filter-white' : '' }}">
            <span class="-mr-1 font-semibold">Assesments</span>
        </a>
        <a href="{{route('students.results')}}"
            class="px-4 py-3 flex items-center space-x-4 rounded-lg shadow-button group bg-white hover:bg-[#ecf7ff] transition ease-in-out {{ request()->routeIs('students.results') ? 'text-white bg-gradient-to-r from-accent-1 to-accent-2' : '' }}">
            <img src="{{asset('icons/ic_student_results.svg')}}" class="{{ request()->routeIs('students.results') ? 'filter-white' : '' }}">
            <span class="-mr-1 font-semibold">Results</span>
        </a>

        <div class="font-bold pt-3">TEACHER SECTION</div>
        <a href="{{route('teacher.create-assessment')}}"
            class="px-4 py-3 flex items-center space-x-4 rounded-lg shadow-button group bg-white hover:bg-[#ecf7ff] transition ease-in-out {{ request()->routeIs('teacher.create-assessment') ? 'text-white bg-gradient-to-r from-accent-1 to-accent-2' : '' }}">
            <img src="{{asset('icons/ic_teacher_create.svg')}}" class="{{ request()->routeIs('teacher.create-assessment') ? 'filter-white' : '' }}">
            <span class="-mr-1 font-semibold">Create Assessment</span>
        </a>
        <a href="{{route('teacher.examine-assessment')}}"
            class="px-4 py-3 flex items-center space-x-4 rounded-lg shadow-button group bg-white hover:bg-[#ecf7ff] transition ease-in-out {{ request()->routeIs('teacher.examine-assessment') ? 'text-white bg-gradient-to-r from-accent-1 to-accent-2' : '' }}">
            <img src="{{asset('icons/ic_teacher_examine.svg')}}" class="{{ request()->routeIs('teacher.examine-assessment') ? 'filter-white' : '' }}">
            <span class="-mr-1 font-semibold">Examine Assessment</span>
        </a>
        <a href="{{route('teacher.review-assessment')}}"
            class="px-4 py-3 flex items-center space-x-4 rounded-lg shadow-button group bg-white hover:bg-[#ecf7ff] transition ease-in-out {{ request()->routeIs('teacher.review-assessment') ? 'text-white bg-gradient-to-r from-accent-1 to-accent-2' : '' }}">
            <img src="{{asset('icons/ic_teacher_review.svg')}}" class="{{ request()->routeIs('teacher.review-assessment') ? 'filter-white' : '' }}">
            <span class="-mr-1 font-semibold">Review Assessment</span>
        </a>

        <div class="font-bold pt-3">ADMIN SECTION</div>
        <div class="relative">
            <button id="accordionButton"
                class="w-full px-4 py-3 flex justify-between items-center space-x-4 rounded-lg shadow-button group bg-white">
                <div class="flex space-x-4"><img src="{{asset('icons/ic_profile.svg')}}">
                    <span class="-mr-1 font-semibold">Admin Panel</span>
                </div>
                <img src="{{asset('icons/ic_down.svg')}}" alt="" >
            </button>
            <div id="accordionMenu" class="hidden flex flex-col mt-4 space-y-4 bg-white w-full">
                <a href="admin.html"
                    class="flex space-x-4 px-4 py-3 items-center hover:bg-[#ecf7ff] transition ease-in-out bg-white rounded-lg shadow-button  ">
                    <img src="{{asset('icons/ic_dashboard.svg')}}">
                    <span class="-mr-1 font-semibold">Admin Panel</span></a>
                <a href="admin.html"
                    class="flex space-x-4 px-4 py-3 items-center hover:bg-[#ecf7ff] transition ease-in-out bg-white rounded-lg shadow-button  ">
                    <img src="{{asset('icons/ic_dashboard.svg')}}">
                    <span class="-mr-1 font-semibold">Admin Panel</span></a>
                <a href="admin.html"
                    class="flex space-x-4 px-4 py-3 items-center hover:bg-[#ecf7ff] transition ease-in-out bg-white rounded-lg shadow-button  ">
                    <img src="{{asset('icons/ic_dashboard.svg')}}">
                    <span class="-mr-1 font-semibold">Admin Panel</span></a>
                <a href="admin.html"
                    class="flex space-x-4 px-4 py-3 items-center hover:bg-[#ecf7ff] transition ease-in-out bg-white rounded-lg shadow-button  ">
                    <img src="{{asset('icons/ic_dashboard.svg')}}">
                    <span class="-mr-1 font-semibold">Admin Panel</span></a>
                <a href="admin.html"
                    class="flex space-x-4 px-4 py-3 items-center hover:bg-[#ecf7ff] transition ease-in-out bg-white rounded-lg shadow-button  ">
                    <img src="{{asset('icons/ic_dashboard.svg')}}">
                    <span class="-mr-1 font-semibold">Admin Panel</span></a>
                <a href="admin.html"
                    class="flex space-x-4 px-4 py-3 items-center hover:bg-[#ecf7ff] transition ease-in-out bg-white rounded-lg shadow-button  ">
                    <img src="{{asset('icons/ic_dashboard.svg')}}">
                    <span class="-mr-1 font-semibold">Admin Panel</span></a>
            </div>
        </div>
    </div>
</aside>
