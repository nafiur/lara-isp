<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column gap-1">
            <h1 class="fs-4 fw-semibold text-body mb-0">{{ __('Edit Router') }}</h1>
            <p class="text-muted small mb-0">
                {{ __('Update connection details for :router.', ['router' => $router->name]) }}
            </p>
        </div>
    </x-slot>
    <x-slot name="breadcrumb">
        {{ __('Network / Edit Router') }}
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('network.routers.update', $router) }}">
                @method('PUT')
                @include('network.routers._form', ['router' => $router])
            </form>
        </div>
    </div>
</x-app-layout>
