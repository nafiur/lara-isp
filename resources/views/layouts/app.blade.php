<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ISP Management System') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary hold-transition">
    @php
        $user = auth()->user();
        $navigation = [
            [
                'label' => __('Dashboard'),
                'icon' => 'fas fa-gauge',
                'route' => 'dashboard',
            ],
            [
                'label' => __('Core Setup'),
                'icon' => 'fas fa-layer-group',
                'disabled' => true,
                'badge' => ['label' => __('Soon'), 'class' => 'bg-secondary'],
            ],
            [
                'label' => __('CRM'),
                'icon' => 'fas fa-users',
                'disabled' => true,
                'badge' => ['label' => __('Soon'), 'class' => 'bg-secondary'],
            ],
            [
                'label' => __('Billing'),
                'icon' => 'fas fa-file-invoice-dollar',
                'disabled' => true,
                'badge' => ['label' => __('Soon'), 'class' => 'bg-secondary'],
            ],
            [
                'label' => __('Network'),
                'icon' => 'fas fa-network-wired',
                'disabled' => true,
                'badge' => ['label' => __('Soon'), 'class' => 'bg-secondary'],
            ],
            [
                'label' => __('Inventory'),
                'icon' => 'fas fa-cubes',
                'disabled' => true,
                'badge' => ['label' => __('Soon'), 'class' => 'bg-secondary'],
            ],
        ];
    @endphp

    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand border-bottom bg-body">
            <div class="container-fluid">
                <button class="btn btn-link text-body-emphasis d-lg-none" data-lte-toggle="sidebar" type="button" aria-label="{{ __('Toggle sidebar') }}">
                    <i class="fas fa-bars fa-lg"></i>
                </button>

                <span class="navbar-brand fw-semibold text-uppercase small mb-0 d-none d-lg-inline">
                    {{ config('app.name') }}
                </span>

                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    @if ($user)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                <span class="avatar avatar-sm rounded-circle bg-primary-subtle text-primary fw-semibold">
                                    {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                                </span>
                                <span class="fw-semibold">{{ $user->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow-sm">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-circle me-2 text-secondary"></i>{{ __('Profile') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-arrow-right-from-bracket me-2"></i>{{ __('Logout') }}
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

        <aside class="app-sidebar sidebar-dark-primary shadow" data-lte-toggle="sidebar" data-lte-widget="app-sidebar">
            <div class="sidebar-brand">
                <a href="{{ route('dashboard') }}" class="brand-link d-flex align-items-center gap-2">
                    <span class="brand-text fw-semibold text-white">{{ config('app.name') }}</span>
                </a>
                <button class="btn btn-link text-white d-lg-none ms-auto" data-lte-toggle="sidebar" type="button" aria-label="{{ __('Close sidebar') }}">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="sidebar-wrapper">
                @if ($user)
                    <div class="px-3 py-3 border-bottom border-opacity-25 border-secondary-subtle">
                        <div class="d-flex align-items-center gap-2">
                            <span class="avatar avatar-md rounded-circle bg-primary-subtle text-primary fw-semibold">
                                {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                            </span>
                            <div>
                                <div class="fw-semibold text-white">{{ $user->name }}</div>
                                <div class="text-white-50 small">{{ $user->email }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" role="menu" data-lte-toggle="treeview">
                        @foreach ($navigation as $item)
                            @php
                                $isActive = isset($item['route']) ? request()->routeIs($item['route']) : false;
                                $linkClasses = collect([
                                    'nav-link',
                                    $isActive ? 'active' : null,
                                    ($item['disabled'] ?? false) ? 'disabled text-white-50' : null,
                                ])->filter()->implode(' ');
                                $href = ($item['disabled'] ?? false) ? '#' : (isset($item['route']) ? route($item['route']) : '#');
                            @endphp
                            <li class="nav-item">
                                <a href="{{ $href }}" class="{{ $linkClasses }}">
                                    <i class="nav-icon {{ $item['icon'] ?? 'fas fa-circle' }}"></i>
                                    <p class="d-flex align-items-center gap-2 mb-0">
                                        <span>{{ $item['label'] }}</span>
                                        @if (isset($item['badge']))
                                            <span class="nav-badge badge {{ $item['badge']['class'] ?? 'bg-secondary' }}">
                                                {{ $item['badge']['label'] }}
                                            </span>
                                        @endif
                                    </p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="sidebar-overlay" data-lte-toggle="sidebar"></div>

        <main class="app-main">
            <div class="app-main-wrapper">
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-sm">
                                @isset($header)
                                    {!! $header !!}
                                @else
                                    <h1 class="mb-0 fs-4 fw-semibold text-body">{{ __('Dashboard') }}</h1>
                                @endisset
                            </div>
                            <div class="col-sm-auto">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">{{ __('Home') }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        @isset($breadcrumb)
                                            {{ $breadcrumb }}
                                        @else
                                            {{ __('Dashboard') }}
                                        @endisset
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="app-content py-3">
                    <div class="container-fluid">
                        {{ $slot }}
                    </div>
                </section>

                <footer class="app-footer small">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row gap-2">
                        <strong>&copy; {{ date('Y') }} {{ config('app.name') }}.</strong>
                        <span class="text-muted">{{ __('Version 0.1.0') }}</span>
                    </div>
                </footer>
            </div>
        </main>
    </div>

    @stack('modals')
    @stack('scripts')
</body>
</html>
