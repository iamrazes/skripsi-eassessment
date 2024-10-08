<aside id="sidebar" class="lg:block hidden bg-white w-80 lg:h-auto h-full lg:rounded-xl shadow-md lg:m-8 flex-shrink-0">
    <!-- Title -->
    <div class="px-4 pt-6 text-accent-1">
        <h1 class="flex justify-center gap-x-2 scale-105">
            <img src="{{ asset('icons/ic_sidebar_logo.svg') }}" alt="">
            <span class="bg-gradient-to-r from-accent-1 to-accent-2 bg-clip-text text-transparent">
                E-Assessment</span>
        </h1>
        <div class="mt-4 h-[1px] bg-gradient-to-r from-white via-accent-1 to-white">
        </div>
    </div>
    <!-- Items -->
    <div class="py-3 px-5 space-y-5">
        <!-- Main -->
        @php
            $dashboardIcon = 'icons/ic_dashboard.svg';
            $profileIcon = 'icons/ic_profile.svg';

            if (Auth::user()->hasRole('teacher') || Auth::user()->hasRole('student')) {
                $dashboardIcon = 'icons/ic_dashboard2.svg';
                $profileIcon = 'icons/ic_profile2.svg';
            }
        @endphp

        <a href="{{ route('dashboard') }}"
            class="px-4 py-3 flex items-center space-x-4 rounded-lg shadow-button group bg-white hover:bg-[#ecf7ff] transition ease-in-out {{ request()->routeIs('dashboard') ? 'text-white bg-gradient-to-r from-accent-1 to-accent-2' : '' }}">
            <img src="{{ asset($dashboardIcon) }}" class="{{ request()->routeIs('dashboard') ? 'filter-white' : '' }}">
            <span class="-mr-1 font-semibold">Dashboard</span>
        </a>
        <a href="{{ route('profile') }}"
            class="px-4 py-3 flex items-center space-x-4 rounded-lg shadow-button group bg-white hover:bg-[#ecf7ff] transition ease-in-out {{ request()->routeIs('profile') ? 'text-white bg-gradient-to-r from-accent-1 to-accent-2' : '' }}">
            <img src="{{ asset($profileIcon) }}" class="{{ request()->routeIs('profile') ? 'filter-white' : '' }}">
            <span class="-mr-1 font-semibold">Profil</span>
        </a>

        @if (auth()->user()->hasPermissionTo('student-access'))
            <div class="font-bold pt-3">RUANGAN MURID</div>
            <a href="{{ route('students.exams.index') }}"
                class="flex space-x-4 px-4 py-3 items-center {{ request()->is('students/exams*') ? 'bg-gradient-to-r from-accent-1 to-accent-2 text-white' : 'bg-white' }} hover:bg-[#ecf7ff] transition ease-in-out rounded-lg shadow-button">
                <img src="{{ asset('icons/ic_assessment3.svg') }}"
                    class="{{ request()->is('students/exams*') ? 'filter-white' : '' }}">
                <span class="-mr-1 font-semibold">Ujian</span>
            </a>
            <a href="{{ route('students.reports.index') }}"
                class="flex space-x-4 px-4 py-3 items-center {{ request()->is('students/reports*') ? 'bg-gradient-to-r from-accent-1 to-accent-2 text-white' : 'bg-white' }} hover:bg-[#ecf7ff] transition ease-in-out rounded-lg shadow-button">
                <img src="{{ asset('icons/ic_assessment-history.svg') }}"
                    class="{{ request()->is('students/reports*') ? 'filter-white' : '' }}">
                <span class="-mr-1 font-semibold">Laporan</span>
            </a>
        @endif

        @if (auth()->user()->hasPermissionTo('teacher-access'))
            <div class="font-bold pt-3">RUANG GURU</div>

            <div class="relative">
                <button id="accordionButton4" data-target="accordionMenu4"
                    class="w-full px-4 py-3 flex justify-between items-center space-x-4 rounded-lg shadow-button group hover:bg-[#ecf7ff] transition ease-in-out
                {{ request()->is('teacher/exams*') || request()->is('teacher/history*') ? 'text-white bg-gradient-to-r from-accent-1 to-accent-2' : 'bg-white' }}">
                    <div class="flex space-x-4">
                        <img src="{{ asset('icons/ic_assessment4.svg') }}"
                            class="{{ request()->is('teacher/exams*') || request()->is('teacher/history*') ? 'filter-white' : '' }}"
                            style="width: 21px; height: 21px;">
                        <span class="-mr-1 font-semibold">Assessments</span>
                    </div>
                    <img src="{{ asset('icons/ic_down.svg') }}"
                        class="{{ request()->is('teacher/exams*') || request()->is('teacher/history*') ? 'filter-white' : '' }}">
                </button>
                <div id="accordionMenu4"
                    class="{{ request()->is('teacher/exams*') ? 'flex' : '' }} flex-col mt-4 space-y-4 bg-white w-full">
                    <a href="{{ route('teacher.exams.index') }}"
                        class="flex space-x-4 px-4 py-3 items-center {{ request()->is('teacher/exams*') ? 'bg-gradient-to-r from-accent-1 to-accent-2 text-white' : 'bg-white' }} hover:bg-[#ecf7ff] transition ease-in-out rounded-lg shadow-button">
                        <img src="{{ asset('icons/ic_assessment3.svg') }}"
                            class="{{ request()->is('teacher/exams*') ? 'filter-white' : '' }} pl-8">
                        <span class="-mr-1 font-semibold">Ujian</span>
                    </a>
                    <a href="{{route('teacher.history.index')}}"
                        class="flex space-x-4 px-4 py-3 items-center {{ request()->is('teacher/history*') ? 'bg-gradient-to-r from-accent-1 to-accent-2 text-white' : 'bg-white' }} hover:bg-[#ecf7ff] transition ease-in-out rounded-lg shadow-button">
                        <img src="{{ asset('icons/ic_assessment-history.svg') }}"
                            class="{{ request()->is('teacher/history*') ? 'filter-white' : '' }} pl-8">
                        <span class="-mr-1 font-semibold">Riwayat Ujian</span>
                    </a>

                </div>
            </div>

            <a href="{{ route('teacher.classrooms.teacherIndex') }}"
                class="flex space-x-4 px-4 py-3 items-center {{ request()->is('teacher/classrooms*') ? 'bg-gradient-to-r from-accent-1 to-accent-2 text-white' : 'bg-white' }} hover:bg-[#ecf7ff] transition ease-in-out rounded-lg shadow-button">
                <img src="{{ asset('icons/ic_classroom2.svg') }}"
                    class="{{ request()->is('teacher/classrooms*') ? 'filter-white' : '' }}">
                <span class="-mr-1 font-semibold">Kelas</span>
            </a>
        @endif

        @if (auth()->user()->hasPermissionTo('admin-access'))
            <div class="font-bold pt-3">RUANG ADMIN</div>
            <div class="relative">
                <button id="accordionButton1" data-target="accordionMenu1"
                    class="w-full px-4 py-3 flex justify-between items-center space-x-4 rounded-lg shadow-button group hover:bg-[#ecf7ff] transition ease-in-out
                {{ request()->is('admin/users*') || request()->is('admin/roles*') || request()->is('admin/permissions*') ? 'text-white bg-gradient-to-r from-accent-1 to-accent-2' : 'bg-white' }}">
                    <div class="flex space-x-4">
                        <img src="{{ asset('icons/ic_gear.svg') }}"
                            class="{{ request()->is('admin/users*') || request()->is('admin/roles*') || request()->is('admin/permissions*') ? 'filter-white' : '' }}"
                            style="width: 21px; height: 21px;">
                        <span class="-mr-1 font-semibold">System Control</span>
                    </div>
                    <img src="{{ asset('icons/ic_down.svg') }}"
                        class="{{ request()->is('admin/users*') || request()->is('admin/roles*') || request()->is('admin/permissions*') ? 'filter-white' : '' }}">
                </button>
                <div id="accordionMenu1"
                    class="{{ request()->is('admin/users*') || request()->is('admin/roles*') || request()->is('admin/permissions*') ? 'flex' : '' }} flex-col mt-4 space-y-4 bg-white w-full">
                    <a href="{{ route('admin.users.index') }}"
                        class="flex space-x-4 px-4 py-3 items-center {{ request()->is('admin/users*') ? 'bg-gradient-to-r from-accent-1 to-accent-2 text-white' : 'bg-white' }} hover:bg-[#ecf7ff] transition ease-in-out rounded-lg shadow-button">
                        <img src="{{ asset('icons/ic_users.svg') }}"
                            class="{{ request()->is('admin/users*') ? 'filter-white' : '' }} pl-8">
                        <span class="-mr-1 font-semibold">Users</span>
                    </a>
                    <a href="{{ route('admin.roles.index') }}"
                        class="flex space-x-4 px-4 py-3 items-center {{ request()->is('admin/roles*') ? 'bg-gradient-to-r from-accent-1 to-accent-2 text-white' : 'bg-white' }} hover:bg-[#ecf7ff] transition ease-in-out rounded-lg shadow-button">
                        <img src="{{ asset('icons/ic_user-gear.svg') }}"
                            class="{{ request()->is('admin/roles*') ? 'filter-white' : '' }} pl-8">
                        <span class="-mr-1 font-semibold">Roles</span>
                    </a>
                    <a href="{{ route('admin.permissions.index') }}"
                        class="flex space-x-4 px-4 py-3 items-center {{ request()->is('admin/permissions*') ? 'bg-gradient-to-r from-accent-1 to-accent-2 text-white' : 'bg-white' }} hover:bg-[#ecf7ff] transition ease-in-out rounded-lg shadow-button">
                        <img src="{{ asset('icons/ic_user-lock.svg') }}"
                            class="{{ request()->is('admin/permissions*') ? 'filter-white' : '' }} pl-8">
                        <span class="-mr-1 font-semibold">Permissions</span>
                    </a>
                </div>
            </div>
            <div class="relative">
                <button id="accordionButton2" data-target="accordionMenu2"
                    class="w-full px-4 py-3 flex justify-between items-center space-x-4 rounded-lg shadow-button group hover:bg-[#ecf7ff] transition ease-in-out
                {{ request()->is('admin/data-admins*') || request()->is('admin/data-teachers*') || request()->is('admin/data-students*') || request()->is('admin/classrooms*') ? 'text-white bg-gradient-to-r from-accent-1 to-accent-2' : 'bg-white' }}">
                    <div class="flex space-x-4">
                        <img src="{{ asset('icons/ic_database2.svg') }}"
                            class="{{ request()->is('admin/data-admins*') || request()->is('admin/data-teachers*') || request()->is('admin/data-students*') || request()->is('admin/classrooms*') ? 'filter-white' : '' }}"
                            style="width: 21px; height: 21px;">
                        <span class="-mr-1 font-semibold">Database Control</span>
                    </div>
                    <img src="{{ asset('icons/ic_down.svg') }}"
                        class="{{ request()->is('admin/data-admins*') || request()->is('admin/data-teachers*') || request()->is('admin/data-students*') || request()->is('admin/classrooms*') ? 'filter-white' : '' }}">
                </button>
                <div id="accordionMenu2"
                    class="{{ request()->is('admin/data-admins*') || request()->is('admin/data-teachers*') || request()->is('admin/data-students*') || request()->is('admin/classrooms*') ? 'flex' : '' }} flex-col mt-4 space-y-4 bg-white w-full">
                    <a href="{{ route('admin.data-admins.index') }}"
                        class="flex space-x-4 px-4 py-3 items-center {{ request()->is('admin/data-admins*') ? 'bg-gradient-to-r from-accent-1 to-accent-2 text-white' : 'bg-white' }} hover:bg-[#ecf7ff] transition ease-in-out rounded-lg shadow-button">
                        <img src="{{ asset('icons/ic_admin.svg') }}"
                            class="{{ request()->is('admin/data-admins*') ? 'filter-white' : '' }} pl-8">
                        <span class="-mr-1 font-semibold">Admin</span>
                    </a>
                    <a href="{{ route('admin.data-teachers.index') }}"
                        class="flex space-x-4 px-4 py-3 items-center {{ request()->is('admin/data-teachers*') ? 'bg-gradient-to-r from-accent-1 to-accent-2 text-white' : 'bg-white' }} hover:bg-[#ecf7ff] transition ease-in-out rounded-lg shadow-button">
                        <img src="{{ asset('icons/ic_teacher.svg') }}"
                            class="{{ request()->is('admin/data-teachers*') ? 'filter-white' : '' }} pl-8">
                        <span class="-mr-1 font-semibold">Guru</span>
                    </a>
                    <a href="{{ route('admin.data-students.index') }}"
                        class="flex space-x-4 px-4 py-3 items-center {{ request()->is('admin/data-students*') ? 'bg-gradient-to-r from-accent-1 to-accent-2 text-white' : 'bg-white' }} hover:bg-[#ecf7ff] transition ease-in-out rounded-lg shadow-button">
                        <img src="{{ asset('icons/ic_student.svg') }}"
                            class="{{ request()->is('admin/data-students*') ? 'filter-white' : '' }} pl-8">
                        <span class="-mr-1 font-semibold">Murid</span>
                    </a>
                    <a href="{{ route('admin.classrooms.index') }}"
                        class="flex space-x-4 px-4 py-3 items-center {{ request()->is('admin/classrooms*') ? 'bg-gradient-to-r from-accent-1 to-accent-2 text-white' : 'bg-white' }} hover:bg-[#ecf7ff] transition ease-in-out rounded-lg shadow-button">
                        <img src="{{ asset('icons/ic_classroom.svg') }}"
                            class="{{ request()->is('admin/classrooms*') ? 'filter-white' : '' }} pl-8">
                        <span class="-mr-1 font-semibold">Kelas</span>
                    </a>
                </div>
            </div>
            <div class="relative">
                <button id="accordionButton3" data-target="accordionMenu3"
                    class="w-full px-4 py-3 flex justify-between items-center space-x-4 rounded-lg shadow-button group hover:bg-[#ecf7ff] transition ease-in-out
                {{ request()->is('admin/exam-types*') || request()->is('admin/subjects*') || request()->is('admin/exam*') ? 'text-white bg-gradient-to-r from-accent-1 to-accent-2' : 'bg-white' }}">
                    <div class="flex space-x-4">
                        <img src="{{ asset('icons/ic_gear.svg') }}"
                            class="{{ request()->is('admin/exam-types*') || request()->is('admin/subjects*') || request()->is('admin/exam*') ? 'filter-white' : '' }}"
                            style="width: 21px; height: 21px;">
                        <span class="-mr-1 font-semibold">Assessment Control</span>
                    </div>
                    <img src="{{ asset('icons/ic_down.svg') }}"
                        class="{{ request()->is('admin/exam-types*') || request()->is('admin/subjects*') || request()->is('admin/exam*') ? 'filter-white' : '' }}">
                </button>
                <div id="accordionMenu3"
                    class="{{ request()->is('admin/exam-types*') || request()->is('admin/subjects*') || request()->is('admin/exam-*') ? 'flex' : '' }} flex-col mt-4 space-y-4 bg-white w-full">

                    <a href="{{ route('admin.exam-types.index') }}"
                        class="flex space-x-4 px-4 py-3 items-center {{ request()->is('admin/exam-types*') ? 'bg-gradient-to-r from-accent-1 to-accent-2 text-white' : 'bg-white' }} hover:bg-[#ecf7ff] transition ease-in-out rounded-lg shadow-button">
                        <img src="{{ asset('icons/ic_typeofexam.svg') }}"
                            class="{{ request()->is('admin/exam-types*') ? 'filter-white' : '' }} pl-8">
                        <span class="-mr-1 font-semibold">Jenis Ujian</span>
                    </a>
                    <a href="{{ route('admin.subjects.index') }}"
                        class="flex space-x-4 px-4 py-3 items-center {{ request()->is('admin/subjects*') ? 'bg-gradient-to-r from-accent-1 to-accent-2 text-white' : 'bg-white' }} hover:bg-[#ecf7ff] transition ease-in-out rounded-lg shadow-button">
                        <img src="{{ asset('icons/ic_subjects.svg') }}"
                            class="{{ request()->is('admin/subjects*') ? 'filter-white' : '' }} pl-8">
                        <span class="-mr-1 font-semibold">Mata Pelajaran</span>
                    </a>
                </div>
            </div>
        @endif
    </div>
</aside>
