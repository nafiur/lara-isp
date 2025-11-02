<x-guest-layout>
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-circle-check me-2"></i>{{ session('status') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="{{ __('Close') }}"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
        @csrf

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
                    autofocus
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
                    <i class="fas fa-lock"></i>
                </span>
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-control border-start-0 @error('password') is-invalid @enderror"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                >
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="remember_me" name="remember">
                <label class="form-check-label small" for="remember_me">
                    {{ __('Remember me') }}
                </label>
            </div>
            @if (Route::has('password.request'))
                <a class="small text-decoration-none text-info" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="d-grid gap-3">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-right-to-bracket me-2"></i>{{ __('Sign in') }}
            </button>

            @if (Route::has('register'))
                <a class="btn btn-outline-light btn-lg" href="{{ route('register') }}">
                    {{ __("Create a new account") }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
