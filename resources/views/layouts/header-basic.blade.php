<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="{{ route('homepage') }}" class="navbar-brand">
            <img src="{{ asset('images/logo_citra.png') }}" alt="AdminLTE Logo" class="brand-image"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name', 'UKMCS') }}</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                           class="nav-link {{ request()->is('home*') ? 'active' : '' }}">Home</a>
                    </li>

                    @if(auth()->user()->role === 'student')
                        <li class="nav-item">
                            <a href="{{ route('myApplication.index') }}"
                               class="nav-link {{ request()->is('myApplication*') ? 'active' : '' }}">Application</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('citras.index') }}"
                               class="nav-link {{ request()->is('citras*') ? 'active' : '' }}">Courses</a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            @auth
                @if(auth()->user()->role === 'student')
                    <li class="nav-item">
                        <a href="{{ route('user_feedback') }}"
                           class="nav-link {{ request()->is('feedback*') ? 'active' : '' }}">Feedback</a>
                    </li>
                @endif

                <!-- Profile Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu border-0 shadow dropdown-menu-right">
                        <li><a href="{{ route('profile') }}" class="dropdown-item">My Account</a></li>

                        <li class="dropdown-divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                               class="dropdown-item">{{ __('Logout') }}</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('login') }}"
                       class="nav-link {{ request()->is('feedback*') ? 'active' : '' }}">Login</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>
<!-- /.navbar -->
