<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block font-outfit"><a href="/" target="_blank"
                    class="nav-link">{{ 'Kecamatan ' . $config->nama_kecamatan }}</a></li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/img/avatar.webp') }}" class="user-image rounded-circle shadow"
                        alt="User Image" />
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-secondary mb-2">
                        <img src="{{ asset('assets/img/avatar.webp') }}" class="rounded-circle shadow"
                            alt="User Image" />
                        <p>
                            {{ Auth::user()->name }}
                            <small>{{ Auth::user()->getRoleNames()->implode(', ') }}</small>
                        </p>
                    </li>
                    <li class="user-footer">
                        <a href="#" class="btn btn-warning ">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <a :href="route('logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();"
                                class="btn btn-danger float-end">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
