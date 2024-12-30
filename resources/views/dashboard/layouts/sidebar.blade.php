<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="./index.html" class="brand-link">
            <span class="brand-text">{{ config('app.alias') }}</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fal fa-gauge"></i>
                        <p>Dashbooard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rentals.index') }}"
                        class="nav-link {{ request()->segment(1) == 'rentals' ? 'active' : '' }}">
                        <i class="nav-icon fal fa-cart-shopping-fast"></i>
                        <p>Penyewaan</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->segment(1) == 'accountancy' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-journal-bookmark-fill"></i>
                        <p>
                            Pembukuan
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('cashins.index') }}"
                                class="nav-link {{ request()->segment(2) == 'cashins' ? 'active' : '' }}">
                                <i class="nav-icon bi bi-journal-arrow-down"></i>
                                <p>Kas Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cashouts.index') }}"
                                class="nav-link {{ request()->segment(2) == 'cashouts' ? 'active' : '' }}">
                                <i class="nav-icon bi bi-journal-arrow-up"></i>
                                <p>Kas Keluar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.index') }}"
                                class="nav-link {{ request()->segment(2) == 'reports' ? 'active' : '' }}">
                                <i class="nav-icon bi bi-journal-richtext"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->segment(1) == 'data' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fal fa-database"></i>
                        <p>
                            Master Data
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('cars.index') }}"
                                class="nav-link {{ request()->segment(2) == 'cars' ? 'active' : '' }}">
                                <i class="nav-icon bi bi-car-front-fill"></i>
                                <p>Data Mobil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index2.html" class="nav-link">
                                <i class="nav-icon fas fa-moped"></i>
                                <p>Data Motor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="nav-icon fal fa-user-injured"></i>
                                <p>Data Sopir</p>
                            </a>
                        </li>
                        @if (Auth::check() && in_array(Auth::user()->role_id, [1, 2]))
                            <li class="nav-item">
                                <a href="{{ route('owners.index') }}"
                                    class="nav-link {{ request()->segment(2) == 'owners' ? 'active' : '' }}">
                                    <i class="nav-icon fal fa-user"></i>
                                    <p>Data Pemilik</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('customers.index') }}"
                                class="nav-link {{ request()->segment(2) == 'customers' ? 'active' : '' }}">
                                <i class="nav-icon fal fa-users"></i>
                                <p>Data Penyewa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (Auth::check() && in_array(Auth::user()->role_id, [1, 2]))
                    <li class="nav-item {{ request()->segment(1) == 'setting' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fal fa-gear"></i>
                            <p>
                                Pengaturan
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('company.index') }}"
                                    class="nav-link {{ request()->segment(2) == 'company' ? 'active' : '' }}">
                                    <i class="nav-icon fal fa-folder-bookmark"></i>
                                    <p>Perusahaan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('application.index') }}"
                                    class="nav-link {{ request()->segment(2) == 'application' ? 'active' : '' }}">
                                    <i class="nav-icon fal fa-sidebar"></i>
                                    <p>Aplikasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}"
                                    class="nav-link {{ request()->segment(2) == 'users' ? 'active' : '' }}">
                                    <i class="nav-icon fal fa-user"></i>
                                    <p>Pengguna</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}"
                                    class="nav-link  {{ request()->segment(2) == 'roles' ? 'active' : '' }}">
                                    <i class="nav-icon fal fa-users"></i>
                                    <p>Grup</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
