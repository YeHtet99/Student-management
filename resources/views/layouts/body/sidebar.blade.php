<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">Company Name</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">CP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ request()->url() == route('home') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <x-menu-item link="{{ route('home') }}">Home</x-menu-item>
                </ul>
            </li>

            <x-menu-title>Management</x-menu-title>

            <li
                class="dropdown {{ Request::is('family') ? 'active' : '' }} {{ Request::is('family/create') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-solid fa-users"></i>
                    <span>Manage Parent</span>
                </a>
                <ul class="dropdown-menu">
                    <x-menu-item link="{{ route('family.index') }}">Parent lists</x-menu-item>
                    <x-menu-item link="{{ route('family.create') }}">Create Parent</x-menu-item>
                </ul>
            </li>

            <li
                class="dropdown {{ Request::is('student') ? 'active' : '' }} {{ Request::is('student/create') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fa-solid fa-address-card"></i>
                    <span>Manage Student</span>
                </a>
                <ul class="dropdown-menu">
                    <x-menu-item link="{{ route('student.index') }}">Student Lists</x-menu-item>
                    <x-menu-item link="{{ route('student.create') }}">Create Student</x-menu-item>

                </ul>

            </li>
            <li
                class="dropdown {{ Request::is('teacher') ? 'active' : '' }} {{ Request::is('teacher/create') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fa-solid fa-person-chalkboard"></i>
                    <span>Manage Teacher</span>
                </a>
                <ul class="dropdown-menu">
                    <x-menu-item link="{{ route('teacher.index') }}">Teacher Lists</x-menu-item>
                    <x-menu-item link="{{ route('teacher.create') }}">Create Teacher</x-menu-item>
                </ul>

            </li>
            <li
                class="dropdown {{ Request::is('grade') ? 'active' : '' }} {{ Request::is('grade/create') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fa-brands fa-autoprefixer"></i>
                    <span>Manage Grade</span>
                </a>
                <ul class="dropdown-menu">
                    <x-menu-item link="{{ route('grade.index') }}">Grade Lists</x-menu-item>
                    <x-menu-item link="{{ route('grade.create') }}">Create Grade</x-menu-item>
                </ul>

            </li>

            <li
                class="dropdown {{ Request::is('course') ? 'active' : '' }} {{ Request::is('course/create') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fa-solid fa-book-bookmark"></i>
                    <span>Manage course</span>
                </a>
                <ul class="dropdown-menu">
                    <x-menu-item link="{{ route('course.index') }}">Course Lists</x-menu-item>
                    <x-menu-item link="{{ route('course.create') }}">Create Course</x-menu-item>
                </ul>

            </li>
            <li
                class="dropdown {{ Request::is('classroom') ? 'active' : '' }} {{ Request::is('classroom/create') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fa-solid fa-person-shelter"></i>
                    <span>Manage classroom</span>
                </a>
                <ul class="dropdown-menu">
                    <x-menu-item link="{{ route('classroom.index') }}">Course Lists</x-menu-item>
                    <x-menu-item link="{{ route('classroom.create') }}">Create Course</x-menu-item>
                </ul>

            </li>



            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                <a href="https://getcodiepie.com/docs" onclick="document.getElementById('logOut').submit()"
                   class="btn btn-primary btn-lg btn-block btn-icon-split"><i class="fas fa-rocket"></i>
                    Documentation</a>

                <form class="d-none" id="logOut" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
    </aside>
</div>
