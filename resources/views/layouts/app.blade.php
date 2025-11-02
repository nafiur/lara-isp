<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed bg-body-tertiary">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-light border-bottom border-light bg-white">
            <div class="container-fluid">
                <button class="btn btn-link text-body" data-lte-toggle="sidebar" type="button" aria-label="Toggle navigation">
                    <i class="fas fa-bars fa-lg"></i>
                </button>

                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    @auth
                        @php($user = auth()->user())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                <span class="avatar avatar-sm rounded-circle bg-primary-subtle text-primary fw-semibold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                                <span class="fw-semibold">{{ $user->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-circle me-2 text-secondary"></i> Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-arrow-right-from-bracket me-2 text-danger"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('dashboard') }}" class="brand-link text-decoration-none text-white">
                <span class="brand-text fw-semibold">{{ config('app.name') }}</span>
            </a>

            <div class="sidebar">
                <nav class="mt-3">
                    <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-gauge"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link disabled text-muted">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>Core Setup</p>
                                <span class="badge bg-secondary ms-auto">Soon</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link disabled text-muted">
                                <i class="nav-icon fas fa-users"></i>
                                <p>CRM</p>
                                <span class="badge bg-secondary ms-auto">Soon</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link disabled text-muted">
                                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                <p>Billing</p>
                                <span class="badge bg-secondary ms-auto">Soon</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link disabled text-muted">
                                <i class="nav-icon fas fa-network-wired"></i>
                                <p>Network</p>
                                <span class="badge bg-secondary ms-auto">Soon</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link disabled text-muted">
                                <i class="nav-icon fas fa-cubes"></i>
                                <p>Inventory</p>
                                <span class="badge bg-secondary ms-auto">Soon</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header py-3 border-bottom">
                <div class="container-fluid d-flex align-items-center justify-content-between">
                    <div>
                        @isset($header)
                            {{ $header }}
                        @else
                            <h1 class="m-0 fs-4 fw-semibold text-body">Dashboard</h1>
                        @endisset
                    </div>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">
                            @isset($breadcrumb)
                                {{ $breadcrumb }}
                            @else
                                Dashboard
                            @endisset
                        </li>
                    </ol>
                </div>
            </div>

            <section class="content py-3">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </section>
        </div>

        <footer class="main-footer small text-muted">
            <div class="float-end d-none d-sm-inline">
                Version 0.1.0
            </div>
            <strong>&copy; {{ date('Y') }} {{ config('app.name') }}.</strong> All rights reserved.
        </footer>
    </div>

    @stack('modals')
    @stack('scripts')
</body>
</html>
