<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center @if(request()->routeIs('home')) fixed-top @endif">
    <div class="container d-flex justify-content-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope"></i> <a href="mailto:contact@example.com">contact@example.com</a>
            <i class="bi bi-phone"></i> +1 5589 55488 55
        </div>
        <div class="d-none d-lg-flex social-links align-items-center">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
    </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="@if(request()->routeIs('home')) fixed-top @endif">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="{{route('home')}}">Medilab</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                @foreach($menu as $link)
                    <li><a class="nav-link @if(request()->routeIs($link->route)) active @endif" href="{{route($link->route)}}">{{$link->name}}</a></li>
                @endforeach

                @if(!Auth::check())
                        <li><a class="nav-link" href="{{route('login')}}">Login</a></li>
                @else
                    <li><a class="nav-link" href="{{route('dashboard')}}">Dashboard</a></li>
                    <li>
                        <form action="{{route('logout')}}" method="POST" id="logoutForm">
                            @csrf
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                 Logout
                            </a>
                        </form>
                    </li>
                @endif

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        @if(Auth::check() && Auth::user()->role_id === 3)
            <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span> Appointment</a>
        @endif

    </div>
</header><!-- End Header -->
