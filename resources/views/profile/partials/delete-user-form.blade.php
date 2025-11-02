<section>
    <header class="mb-4">
        <h2 class="h5 fw-semibold mb-1 text-danger">{{ __('Delete Account') }}</h2>
        <p class="text-muted small mb-0">
            {{ __('Once your account is deleted, all associated resources and data will be permanently removed. Download anything you need before continuing.') }}
        </p>
    </header>

    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">
        <i class="fas fa-user-slash me-2"></i>{{ __('Delete Account') }}
    </button>

    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirm-user-deletion-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title" id="confirm-user-deletion-label">{{ __('Confirm account deletion') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted">
                            {{ __('This action cannot be undone. Please confirm your password to permanently delete your account.') }}
                        </p>

                        <div class="mb-3">
                            <label for="delete_password" class="form-label">{{ __('Password') }}</label>
                            <input
                                id="delete_password"
                                name="password"
                                type="password"
                                class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                placeholder="{{ __('Enter password to confirm') }}"
                                required
                            >
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    @if ($errors->userDeletion->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const modalElement = document.getElementById('confirm-user-deletion');
                if (modalElement) {
                    const modal = new window.bootstrap.Modal(modalElement);
                    modal.show();
                }
            });
        </script>
    @endif
@endpush
