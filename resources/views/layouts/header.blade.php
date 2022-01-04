<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @if(Auth::check())
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="flag-icon flag-icon-us"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right p-0">
                    @foreach(config('app.available_locales') as $locale_name => $locale)
                        <a href="{{ route('language', $locale) }}" class="dropdown-item {{ app()->getLocale() === $locale ? 'active' : '' }}">
                            <i class="flag-icon flag-icon-us mr-2"></i> {{ $locale_name }}
                        </a>
                    @endforeach
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-none d-md-inline-block" href="#" id="navbarDropdown2" role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>

                <a class="nav-link d-block d-sm-none" data-toggle="dropdown" href="#">
                    <i class="far fa-user-circle"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
                    <a class="dropdown-item {{ request()->is('profile') ? 'active' : '' }}"
                       href="{{ route('profile') }}">{{ __('My Account') }}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endif
    </ul>
</nav>
<!-- /.navbar -->
