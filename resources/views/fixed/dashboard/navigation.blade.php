<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('dashboard.profile')}}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
        @if(Auth::user()->role_id === 1)
            <hr/>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('dashboard.users')}}">
                    <i class="bi bi-person"></i>
                    <span>Users</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('dashboard.departments')}}">
                    <i class="ri-bank-line"></i>
                    <span>Departments</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('dashboard.specializations')}}">
                    <i class="ri-stethoscope-line"></i>
                    <span>Specializations</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('dashboard.medications')}}">
                    <i class="ri-medicine-bottle-line"></i>
                    <span>Medications</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('dashboard.author')}}">
                    <i class="bi bi-person-badge-fill"></i>
                    <span>Author</span>
                </a>
            </li><!-- End Profile Page Nav -->
        @endif

    </ul>

</aside><!-- End Sidebar-->
