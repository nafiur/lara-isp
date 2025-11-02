<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column gap-1">
            <h1 class="fs-4 fw-semibold text-body mb-0">{{ __('Add Router') }}</h1>
            <p class="text-muted small mb-0">
                {{ __('Register a new Mikrotik router for provisioning and monitoring.') }}
            </p>
        </div>
    </x-slot>
    <x-slot name="breadcrumb">
        {{ __('Network / Add Router') }}
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('network.routers.store') }}">
                @include('network.routers._form')
            </form>
        </div>
    </div>
</x-app-layout>
