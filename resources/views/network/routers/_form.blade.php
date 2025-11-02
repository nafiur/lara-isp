@php
    $isEdit = isset($router);
@endphp

@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label text-uppercase small fw-semibold">{{ __('Name') }}</label>
        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $router->name ?? '') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="host" class="form-label text-uppercase small fw-semibold">{{ __('Host / IP') }}</label>
        <input type="text" id="host" name="host" class="form-control @error('host') is-invalid @enderror"
               value="{{ old('host', $router->host ?? '') }}" required>
        @error('host')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <label for="api_port" class="form-label text-uppercase small fw-semibold">{{ __('API Port') }}</label>
        <input type="number" id="api_port" name="api_port" class="form-control @error('api_port') is-invalid @enderror"
               value="{{ old('api_port', $router->api_port ?? 8728) }}" min="1" max="65535" required>
        @error('api_port')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <label for="connection_type" class="form-label text-uppercase small fw-semibold">{{ __('Connection') }}</label>
        <select id="connection_type" name="connection_type" class="form-select @error('connection_type') is-invalid @enderror">
            <option value="api" @selected(old('connection_type', $router->connection_type ?? 'api') === 'api')>API</option>
            <option value="ssh" @selected(old('connection_type', $router->connection_type ?? 'api') === 'ssh')>SSH</option>
        </select>
        @error('connection_type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="username" class="form-label text-uppercase small fw-semibold">{{ __('Username') }}</label>
        <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror"
               value="{{ old('username', $router->username ?? '') }}" required>
        @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="password" class="form-label text-uppercase small fw-semibold">{{ __('Password') }}</label>
        <input type="password" id="password" name="password"
               class="form-control @error('password') is-invalid @enderror"
               placeholder="{{ $isEdit ? __('Leave blank to keep existing password') : __('Enter password') }}"
               {{ $isEdit ? '' : 'required' }}>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <label for="status" class="form-label text-uppercase small fw-semibold">{{ __('Status') }}</label>
        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="active" @selected(old('status', $router->status ?? 'active') === 'active')>{{ __('Active') }}</option>
            <option value="inactive" @selected(old('status', $router->status ?? 'active') === 'inactive')>{{ __('Inactive') }}</option>
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 d-flex align-items-end">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="use_ssl" name="use_ssl"
                   value="1" @checked(old('use_ssl', $router->use_ssl ?? false))>
            <label class="form-check-label" for="use_ssl">{{ __('Use SSL') }}</label>
        </div>
    </div>

    <div class="col-12">
        <label for="meta_notes" class="form-label text-uppercase small fw-semibold">{{ __('Notes') }}</label>
        <textarea id="meta_notes" name="meta[notes]" rows="3"
                  class="form-control @error('meta.notes') is-invalid @enderror"
                  placeholder="{{ __('Optional notes or instructions') }}">{{ old('meta.notes', $router->meta['notes'] ?? '') }}</textarea>
        @error('meta.notes')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('network.routers.index') }}" class="btn btn-outline-secondary">
        {{ __('Cancel') }}
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-2"></i>{{ $isEdit ? __('Update Router') : __('Create Router') }}
    </button>
</div>
