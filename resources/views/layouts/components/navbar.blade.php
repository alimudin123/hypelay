<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @auth
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary text-center">
                    @if (Auth::user()->user_image)
                    <img src="{{ Auth::user()->user_image }}" class="img-circle elevation-2" alt="User Image">
                    @else
                    <img src="{{ asset('vendor/adminlte3/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    @endif
                    <p class="mt-2">
                        {{ Auth::user()->name }}
                        <small>Bergabung pada @DateIndo(Auth::user()->created_at)</small>
                    </p>
                </li>

                <!-- Menu Footer -->
                <li class="user-footer">
                    <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
        @else
        <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link">Login</a>
        </li>
        @endauth
    </ul>
</nav>