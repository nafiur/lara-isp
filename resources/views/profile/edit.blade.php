<x-app-layout>
    <x-slot name="header">
        <h1 class="fs-4 fw-semibold text-body mb-0">{{ __('Account Settings') }}</h1>
        <p class="text-muted small mb-0">
            {{ __('Manage your personal information, credentials, and account access.') }}
        </p>
    </x-slot>
    <x-slot name="breadcrumb">
        {{ __('Profile') }}
    </x-slot>

    <div class="row g-3">
        <div class="col-xl-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card shadow-sm h-100 border-danger-subtle">
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
