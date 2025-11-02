<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column gap-1">
            <h1 class="fs-4 fw-semibold text-body mb-0">{{ __('Routers') }}</h1>
            <p class="text-muted small mb-0">
                {{ __('Manage Mikrotik routers connected to your network infrastructure.') }}
            </p>
        </div>
    </x-slot>
    <x-slot name="breadcrumb">
        {{ __('Network') }}
    </x-slot>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 d-flex align-items-center justify-content-between">
            <div>
                <h2 class="card-title fs-5 fw-semibold mb-0">{{ __('Configured Routers') }}</h2>
                <p class="text-muted small mb-0">
                    {{ $routers->total() }} {{ \\Illuminate\\Support\\Str::plural(__('router'), $routers->total()) }}
                </p>
            </div>
            @can('network.manage')
                <a href="{{ route('network.routers.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>{{ __('Add Router') }}
                </a>
            @endcan
        </div>

        <div class="card-body p-0">
            @if (session('status'))
                <div class="alert alert-success mx-3 mt-3">
                    <i class="fas fa-circle-check me-2"></i>{{ session('status') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Host') }}</th>
                            <th>{{ __('Port') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Last Sync') }}</th>
                            <th class="text-end">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($routers as $router)
                            <tr>
                                <td class="fw-semibold">{{ $router->name }}</td>
                                <td><code>{{ $router->host }}</code></td>
                                <td>{{ $router->api_port }}</td>
                                <td>
                                    <span class="badge {{ $router->status === 'active' ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                        {{ ucfirst($router->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if ($router->last_synced_at)
                                        <span class="text-muted small">{{ $router->last_synced_at->diffForHumans() }}</span>
                                    @else
                                        <span class="text-muted">{{ __('Never') }}</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        @can('network.manage')
                                            <a href="{{ route('network.routers.edit', $router) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form action="{{ route('network.routers.destroy', $router) }}" method="POST" onsubmit="return confirm('{{ __('Delete this router? This action cannot be undone.') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-network-wired fa-2x mb-2"></i>
                                    <p class="mb-0">{{ __('No routers configured yet.') }}</p>
                                    @can('network.manage')
                                        <a class="btn btn-link p-0 mt-2" href="{{ route('network.routers.create') }}">
                                            {{ __('Add your first router') }}
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($routers->hasPages())
            <div class="card-footer bg-white border-0">
                {{ $routers->withQueryString()->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
