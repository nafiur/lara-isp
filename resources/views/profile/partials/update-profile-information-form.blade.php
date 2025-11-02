<section>
    <header class="mb-4">
        <h2 class="h5 fw-semibold mb-1">{{ __('Profile Information') }}</h2>
        <p class="text-muted small mb-0">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="row g-3">
        @csrf
        @method('patch')

        <div class="col-md-6">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                class="form-control @error('name') is-invalid @enderror"
                required
                autocomplete="name"
                autofocus
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                class="form-control @error('email') is-invalid @enderror"
                required
                autocomplete="username"
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="col-12">
                <div class="alert alert-warning d-flex align-items-center justify-content-between" role="alert">
                    <div>
                        <strong>{{ __('Email verification pending.') }}</strong>
                        <span class="d-block small">
                            {{ __('Your email address is unverified. Please check your inbox or send another verification email.') }}
                        </span>
                    </div>
                    <button form="send-verification" class="btn btn-sm btn-outline-warning">
                        {{ __('Resend verification') }}
                    </button>
                </div>
            </div>

            @if (session('status') === 'verification-link-sent')
                <div class="col-12">
                    <div class="alert alert-success mb-0" role="alert">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </div>
                </div>
            @endif
        @endif

        <div class="col-12 d-flex justify-content-end gap-2 mt-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>{{ __('Save changes') }}
            </button>
        </div>

        @if (session('status') === 'profile-updated')
            <div class="col-12">
                <div class="alert alert-success mb-0" role="alert">
                    {{ __('Profile updated successfully.') }}
                </div>
            </div>
        @endif
    </form>
</section>
