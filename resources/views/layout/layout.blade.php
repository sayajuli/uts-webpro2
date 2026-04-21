<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SIAKAD')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="app-shell">
    <div class="app-layout">
        <!-- Sidebar -->
        <nav class="sidebar d-flex flex-column p-4" id="sidebar">
            <div class="mb-4">
                <h5 class="text-center mb-4">
                    <i class="fas fa-graduation-cap"></i> SIAKAD
                </h5>
                <hr class="my-3">
            </div>

            <ul class="nav flex-column grow">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jurusan.*') ? 'active' : '' }}" href="{{ route('jurusan.index') }}">
                        <i class="fas fa-building"></i> Jurusan
                    </a>
                </li>
                @if (Route::has('mahasiswa.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}" href="{{ route('mahasiswa.index') }}">
                            <i class="fas fa-users"></i> Mahasiswa
                        </a>
                    </li>
                @endif
                @if (Route::has('matakuliah.index'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('matakuliah.*') ? 'active' : '' }}" href="{{ route('matakuliah.index') }}">
                            <i class="fas fa-book"></i> Matakuliah
                        </a>
                    </li>
                @endif
            </ul>

            <div class="mt-auto">
                <hr class="my-3">
                <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-panel">
            <!-- Topbar -->
            <div class="topbar d-flex justify-content-between align-items-center">
                <button class="btn btn-outline-secondary d-md-none" type="button" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-circle fa-lg me-2"></i>
                    <span>{{ Auth::user()->name ?? 'User' }}</span>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
