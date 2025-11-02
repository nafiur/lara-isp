<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label text-uppercase small fw-semibold">{{ __('Full name') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0 text-secondary">
                    <i class="fas fa-user"></i>
                </span>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="form-control border-start-0 @error('name') is-invalid @enderror"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="{{ __('Jane Doe') }}"
                >
            </div>
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label text-uppercase small fw-semibold">{{ __('Email address') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0 text-secondary">
                    <i class="fas fa-at"></i>
                </span>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control border-start-0 @error('email') is-invalid @enderror"
                    required
                    autocomplete="username"
                    placeholder="you@example.com"
                >
            </div>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label text-uppercase small fw-semibold">{{ __('Password') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0 text-secondary">
                    <i class="fas fa-key"></i>
                </span>
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-control border-start-0 @error('password') is-invalid @enderror"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                >
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
            <div class="form-text text-secondary small">
                {{ __('Use 8+ characters with a mix of letters, numbers, and symbols for best security.') }}
            </div>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label text-uppercase small fw-semibold">{{ __('Confirm password') }}</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                required
                autocomplete="new-password"
                placeholder="••••••••"
            >
            @error('password_confirmation')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid gap-3">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-user-plus me-2"></i>{{ __('Create account') }}
            </button>
            <a class="btn btn-outline-light btn-lg" href="{{ route('login') }}">
                {{ __('Already registered? Sign in') }}
            </a>
        </div>
    </form>
</x-guest-layout>
