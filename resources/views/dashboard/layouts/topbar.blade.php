<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i> </a> </li>
            <li class="nav-item font-outfit fw-semibold d-md-block"> <a href="{{ route('dashboard') }}"
                    class="nav-link">{{ $company->name }}</a> </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell"></i>
                    <span class="navbar-badge badge text-bg-danger">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-envelope me-2"></i> 4 new messages
                        <span class="float-end text-secondary fs-7">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-people-fill me-2"></i> 8 friend requests
                        <span class="float-end text-secondary fs-7">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                        <span class="float-end text-secondary fs-7">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">
                        See All Notifications
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    @if (Auth::user()->foto)
                        <img src="{{ asset('storage/' . Auth::user()->foto) }}" class="user-image rounded-2 shadow"
                            alt="{{ Auth::user()->name }}">
                    @else
                        <img src="{{ '/assets/img/user3-128x128.jpg' }}" class="user-image rounded-2 shadow"
                            alt="{{ Auth::user()->name }}">
                    @endif
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="user-header">
                        <div class="text-bg-primary">
                            @if (Auth::user()->foto)
                                <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                                    class="mb-2 rounded-circle shadow avatar" alt="{{ Auth::user()->name }}">
                            @else
                                <img src="{{ '/assets/img/user3-128x128.jpg' }}"
                                    class="mb-2 rounded-circle shadow avatar" alt="{{ Auth::user()->name }}">
                            @endif
                            <p class="font-outfit fw-medium mb-0">
                                {{ Auth::user()->name }}
                            </p>
                        </div>
                    </li>
                    <li class="user-footer">
                        <div class="d-grid gap-1">
                            <a href="{{ route('users.profile', Auth::user()->id) }}"
                                class="btn btn-success btn-sm rounded-2">Profil</a>
                            <a href="" class="btn btn-warning btn-sm rounded-2">Ganti Password</a>
                            <a href="{{ route('logout') }}" class="btn btn-danger btn-sm rounded-2">Sign Out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
