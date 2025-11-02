<x-app-layout>
    <x-slot name="header">
        <h1 class="fs-4 fw-semibold text-body mb-0">Operations Overview</h1>
        <p class="text-muted small mb-0">Monitor key ISP metrics and jump into daily tasks.</p>
    </x-slot>
    <x-slot name="breadcrumb">
        Dashboard
    </x-slot>

    <div class="row g-3">
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-uppercase text-muted fw-semibold small mb-1">Active Subscribers</p>
                        <h3 class="fw-bold mb-0">1,248</h3>
                        <span class="text-success small"><i class="fas fa-arrow-up me-1"></i>3.2% vs last month</span>
                    </div>
                    <div class="avatar avatar-lg bg-primary-subtle text-primary d-flex align-items-center justify-content-center rounded-3">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-uppercase text-muted fw-semibold small mb-1">Monthly Revenue</p>
                        <h3 class="fw-bold mb-0">৳3.6M</h3>
                        <span class="text-success small"><i class="fas fa-arrow-up me-1"></i>5.1% vs forecast</span>
                    </div>
                    <div class="avatar avatar-lg bg-success-subtle text-success d-flex align-items-center justify-content-center rounded-3">
                        <i class="fas fa-coins fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-uppercase text-muted fw-semibold small mb-1">Pending Tickets</p>
                        <h3 class="fw-bold mb-0">42</h3>
                        <span class="text-danger small"><i class="fas fa-arrow-up me-1"></i>12 unresolved</span>
                    </div>
                    <div class="avatar avatar-lg bg-warning-subtle text-warning d-flex align-items-center justify-content-center rounded-3">
                        <i class="fas fa-headset fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-uppercase text-muted fw-semibold small mb-1">Devices Offline</p>
                        <h3 class="fw-bold mb-0">6</h3>
                        <span class="text-muted small">Last check 5 mins ago</span>
                    </div>
                    <div class="avatar avatar-lg bg-danger-subtle text-danger d-flex align-items-center justify-content-center rounded-3">
                        <i class="fas fa-network-wired fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-lg-8">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h2 class="card-title fs-5 fw-semibold mb-0">Billing Cycle Progress</h2>
                    <a href="#" class="btn btn-sm btn-outline-primary disabled">View detailed report</a>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">A chart placeholder to visualize collection trend once metrics are wired.</p>
                    <div class="placeholder-glow">
                        <div class="placeholder col-12 rounded" style="height: 220px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <h2 class="card-title fs-5 fw-semibold mb-0">Quick Actions</h2>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">
                        Create invoice batch
                        <span class="badge bg-secondary">Soon</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">
                        Provision Mikrotik users
                        <span class="badge bg-secondary">Soon</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">
                        Sync payment gateway
                        <span class="badge bg-secondary">Soon</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">
                        Assign CPE devices
                        <span class="badge bg-secondary">Soon</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
