<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link logo-switch">
        <img src="{{ asset('images/logo_ukm.png') }}" alt="AdminLTE Logo" class="brand-image-xs logo-xl"
             style="opacity: .8;"/>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @auth
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('images/profile.png') }}" class="img-circle elevation-2" alt="User Image" />
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    @if(\Illuminate\Support\Facades\Auth::user()->role === 'lecturer')
                        <li class="nav-header">LECTURER</li>
                        <!-- Lecturer -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                               class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    {{ __('Dashboard') }}
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('application.index') }}"
                               class="nav-link {{ request()->is('application*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file fa-sm "></i>
                                <p>{{ __('Application') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('mycitra.index') }}"
                               class="nav-link {{ request()->is('mycitra*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-list "></i>
                                <p>{{ __('Courses') }}</p>
                            </a>
                        </li>
                    @endif

                    @if(\Illuminate\Support\Facades\Auth::user()->role === 'admin')
                        <li class="nav-header">ADMIN</li>

                        <!-- System Manager -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                               class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    {{ __('Dashboard') }}
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('announcement.index') }}"
                               class="nav-link {{ request()->is('announcement*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-bullhorn "></i>
                                <p>{{ __('Announcement') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('citra.index') }}"
                               class="nav-link {{ request()->is('citra*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-list "></i>
                                <p>{{ __('Courses') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('feedback.index') }}"
                               class="nav-link {{ request()->is('feedback*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-comment-alt "></i>
                                <p>{{ __('Feedback') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                               class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user "></i>
                                <p>{{ __('Users') }}</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        @endauth()
    </div>
    <!-- /.sidebar -->
</aside>
