<x-app-layout>
    <x-slot name="header">
        <h1 class="fs-4 fw-semibold text-body mb-0">{{ __('Operations Overview') }}</h1>
        <p class="text-muted small mb-0">{{ __('Monitor active users, provisioning activity, and spotlight recent changes.') }}</p>
    </x-slot>
    <x-slot name="breadcrumb">
        Dashboard
    </x-slot>

    <div class="row g-3">
        <div class="col-xxl-3 col-sm-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-uppercase text-muted fw-semibold small mb-1">{{ __('Total Users') }}</p>
                        <h3 class="fw-bold mb-0">{{ number_format($metrics['totalUsers']) }}</h3>
                        <span class="small text-muted">{{ __('Across all companies in the system') }}</span>
                    </div>
                    <div class="avatar avatar-lg bg-primary-subtle text-primary d-flex align-items-center justify-content-center rounded-3">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-uppercase text-muted fw-semibold small mb-1">{{ __('New Users (7 days)') }}</p>
                        <h3 class="fw-bold mb-0">{{ number_format($metrics['newUsersThisWeek']) }}</h3>
                        <span class="small text-success">
                            <i class="fas fa-user-plus me-1"></i>{{ __('Recent onboarding activity') }}
                        </span>
                    </div>
                    <div class="avatar avatar-lg bg-success-subtle text-success d-flex align-items-center justify-content-center rounded-3">
                        <i class="fas fa-chart-line fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-uppercase text-muted fw-semibold small mb-1">{{ __('Pending Verifications') }}</p>
                        <h3 class="fw-bold mb-0">{{ number_format($metrics['pendingVerifications']) }}</h3>
                        <span class="small text-warning">
                            <i class="fas fa-envelope-open-text me-1"></i>{{ __('Awaiting email confirmation') }}
                        </span>
                    </div>
                    <div class="avatar avatar-lg bg-warning-subtle text-warning d-flex align-items-center justify-content-center rounded-3">
                        <i class="fas fa-triangle-exclamation fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-uppercase text-muted fw-semibold small mb-1">{{ __('API Tokens Issued') }}</p>
                        <h3 class="fw-bold mb-0">{{ number_format($metrics['apiTokensIssued']) }}</h3>
                        <span class="small text-muted">{{ __('Active Sanctum personal access tokens') }}</span>
                    </div>
                    <div class="avatar avatar-lg bg-info-subtle text-info d-flex align-items-center justify-content-center rounded-3">
                        <i class="fas fa-key fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h2 class="card-title fs-5 fw-semibold mb-0">{{ __('Recent Registrations') }}</h2>
                    <span class="badge bg-primary-subtle text-primary">{{ __('Last 6 users') }}</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Email') }}</th>
                                <th scope="col" class="text-nowrap">{{ __('Joined') }}</th>
                                <th scope="col" class="text-center">{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentUsers as $user)
                                <tr>
                                    <td class="fw-semibold">{{ $user->name }}</td>
                                    <td>
                                        <span class="text-muted small">{{ $user->email }}</span>
                                    </td>
                                    <td class="text-muted small">
                                        {{ $user->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($user->hasVerifiedEmail())
                                            <span class="badge bg-success-subtle text-success fw-semibold">
                                                <i class="fas fa-circle-check me-1"></i>{{ __('Verified') }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning fw-semibold">
                                                <i class="fas fa-clock me-1"></i>{{ __('Pending') }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox-open me-2"></i>{{ __('No users yet. Registrations will appear here.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100 mb-3 mb-lg-4">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h2 class="card-title fs-6 fw-semibold mb-0">{{ __('API Token Activity') }}</h2>
                    <span class="badge bg-info-subtle text-info">{{ __('Most recent 6') }}</span>
                </div>
                <div class="list-group list-group-flush small">
                    @forelse ($recentTokens as $token)
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fw-semibold text-body">{{ $token->name ?? __('Unnamed token') }}</div>
                                <div class="text-muted">
                                    {{ optional($token->tokenable)->name ?? __('Unknown owner') }}
                                </div>
                                <div class="text-muted">
                                    <i class="fas fa-calendar-plus me-1"></i>{{ $token->created_at?->format('d M, H:i') }}
                                </div>
                            </div>
                            <span class="badge bg-primary-subtle text-primary">
                                @if ($token->last_used_at)
                                    <i class="fas fa-bolt me-1"></i>{{ __('Used :time ago', ['time' => $token->last_used_at->diffForHumans()]) }}
                                @else
                                    <i class="fas fa-moon me-1"></i>{{ __('Idle') }}
                                @endif
                            </span>
                        </div>
                    @empty
                        <div class="list-group-item text-center text-muted py-4">
                            <i class="fas fa-key me-2"></i>{{ __('No API tokens created yet.') }}
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0">
                    <h2 class="card-title fs-5 fw-semibold mb-0">{{ __('Quick Actions') }}</h2>
                    <p class="text-muted small mb-0">{{ __('Shortcuts for upcoming ISP modules') }}</p>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">
                        <span><i class="fas fa-file-invoice me-2 text-primary"></i>{{ __('Create invoice batch') }}</span>
                        <span class="badge bg-secondary">{{ __('Soon') }}</span>
                    </a>
                    @can('network.manage')
                        <a href="{{ route('network.routers.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-network-wired me-2 text-success"></i>{{ __('Manage routers') }}</span>
                            <span class="badge bg-success-subtle text-success">{{ __('Live') }}</span>
                        </a>
                    @elseif(auth()->user()?->can('network.view'))
                        <a href="{{ route('network.routers.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-network-wired me-2 text-success"></i>{{ __('View routers') }}</span>
                            <span class="badge bg-primary-subtle text-primary">{{ __('View only') }}</span>
                        </a>
                    @else
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">
                            <span><i class="fas fa-network-wired me-2 text-success"></i>{{ __('Manage routers') }}</span>
                            <span class="badge bg-secondary">{{ __('Access required') }}</span>
                        </a>
                    @endcan
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">
                        <span><i class="fas fa-credit-card me-2 text-info"></i>{{ __('Sync payment gateway') }}</span>
                        <span class="badge bg-secondary">{{ __('Soon') }}</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">
                        <span><i class="fas fa-boxes-stacked me-2 text-warning"></i>{{ __('Assign CPE devices') }}</span>
                        <span class="badge bg-secondary">{{ __('Soon') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
