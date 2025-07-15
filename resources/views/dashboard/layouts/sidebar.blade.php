<aside class="shadow app-sidebar bg-body-secondary" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/img/logo.png') }}" alt="{{ config('app.name') }}" class="opacity-75 brand-image" />
            {{-- <div class="brand-text fw-light">{{ config('app.author') }}</div> --}}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @foreach (getMenus() as $menu)
                    @can($menu->url . ' read')
                        <li class="nav-item {{ request()->segment(1) == $menu->url ? 'menu-open' : '' }}">
                            <a href="{{ $menu->subMenus->count() > 0 ? '#' : url($menu->url ?: '#') }}" class="nav-link">
                                <i class="nav-icon bi {{ $menu->icon }}"></i>
                                <p>
                                    {{ $menu->name }}
                                    @if (count($menu->subMenus) > 0)
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    @endif
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach ($menu->subMenus as $submenu)
                                    @can(explode('/', $submenu->url)[1] . ' read')
                                        <li class="nav-item">
                                            <a href="{{ url($submenu->url) }}"
                                                class="nav-link {{ request()->segment(2) == explode('/', $submenu->url)[1] ? 'active' : '' }}">
                                                <i class="nav-icon bi {{ $submenu->icon }}"></i>
                                                <p>{{ $submenu->name }}</p>
                                            </a>
                                        </li>
                                    @endcan
                                @endforeach
                            </ul>
                        </li>
                    @endcan
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
