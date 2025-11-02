<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column gap-1">
            <h1 class="fs-4 fw-semibold text-body mb-0">{{ __('Core Setup') }}</h1>
            <p class="text-muted small mb-0">
                {{ __('Manage your company and branch context to control what data you are working with.') }}
            </p>
        </div>
    </x-slot>
    <x-slot name="breadcrumb">
        {{ __('Core Setup') }}
    </x-slot>

    <div class="row g-3">
        <div class="col-xl-7">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="card-title fs-5 fw-semibold mb-0">{{ __('Companies & Branches') }}</h2>
                        <p class="text-muted small mb-0">{{ __('Select the company and branch you wish to operate under.') }}</p>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success d-flex align-items-center gap-2" role="alert">
                            <i class="fas fa-circle-check"></i>
                            <span>{{ session('status') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('setup.core.update') }}" class="row g-3">
                        @csrf

                        <div class="col-12">
                            <label for="company_id" class="form-label text-uppercase small fw-semibold">{{ __('Company') }}</label>
                            <select id="company_id" name="company_id" class="form-select" required>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"
                                        data-branches='@json($branchesByCompany->get($company->id)?->map(fn ($branch) => ['id' => $branch->id, 'name' => $branch->name])->values() ?? [])'
                                        @selected($currentCompany && $currentCompany->id === $company->id)>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="branch_id" class="form-label text-uppercase small fw-semibold">{{ __('Branch') }}</label>
                            <select id="branch_id" name="branch_id" class="form-select">
                                <option value="">{{ __('All branches') }}</option>
                                @if ($currentCompany)
                                    @foreach ($branchesByCompany->get($currentCompany->id, collect()) as $branch)
                                        <option value="{{ $branch->id }}" @selected($currentBranch && $currentBranch->id === $branch->id)>
                                            {{ $branch->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('branch_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check me-2"></i>{{ __('Apply context') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0">
                    <h2 class="card-title fs-5 fw-semibold mb-0">{{ __('Current Context') }}</h2>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5 text-muted">{{ __('Company') }}</dt>
                        <dd class="col-sm-7 fw-semibold">
                            {{ $currentCompany?->name ?? __('None') }}
                        </dd>

                        <dt class="col-sm-5 text-muted">{{ __('Branch') }}</dt>
                        <dd class="col-sm-7 fw-semibold">
                            {{ $currentBranch?->name ?? __('All branches') }}
                        </dd>

                        <dt class="col-sm-5 text-muted">{{ __('Timezone') }}</dt>
                        <dd class="col-sm-7">
                            {{ $currentBranch?->timezone ?? $currentCompany?->timezone ?? config('app.timezone') }}
                        </dd>

                        <dt class="col-sm-5 text-muted">{{ __('Support Contact') }}</dt>
                        <dd class="col-sm-7">
                            <div class="d-flex flex-column">
                                <small class="text-muted">{{ __('Email:') }}</small>
                                <span>{{ $currentBranch?->support_email ?? $currentCompany?->support_email ?? '—' }}</span>
                                <small class="text-muted mt-2">{{ __('Phone:') }}</small>
                                <span>{{ $currentBranch?->support_phone ?? $currentCompany?->support_phone ?? '—' }}</span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>

            <div class="card shadow-sm border-0 mt-3">
                <div class="card-header bg-white border-0">
                    <h2 class="card-title fs-6 fw-semibold mb-0">{{ __('Membership Overview') }}</h2>
                </div>
                <div class="card-body">
                    <p class="text-muted small">
                        {{ __('You have access to :companies companies and :branches branches.', ['companies' => $companies->count(), 'branches' => $user->branches->count()]) }}
                    </p>
                    <ul class="list-group list-group-flush small">
                        @foreach ($companies as $company)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fw-semibold">{{ $company->name }}</div>
                                    <div class="text-muted">
                                        {{ trans_choice('{0} No branches|{1} :count branch|[2,*] :count branches', $company->branches->count(), ['count' => $company->branches->count()]) }}
                                    </div>
                                </div>
                                @if ($currentCompany && $currentCompany->id === $company->id)
                                    <span class="badge bg-success-subtle text-success">{{ __('Active') }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const companySelect = document.getElementById('company_id');
                const branchSelect = document.getElementById('branch_id');

                if (!companySelect || !branchSelect) {
                    return;
                }

                const renderBranches = (branches = []) => {
                    branchSelect.innerHTML = '';
                    branchSelect.appendChild(new Option('{{ __('All branches') }}', ''));
                    branches.forEach(branch => {
                        const option = new Option(branch.name, branch.id);
                        branchSelect.appendChild(option);
                    });
                };

                companySelect.addEventListener('change', (event) => {
                    const selectedOption = event.target.selectedOptions[0];
                    const branches = selectedOption?.dataset?.branches ? JSON.parse(selectedOption.dataset.branches) : [];
                    renderBranches(branches);
                });
            });
        </script>
    @endpush
</x-app-layout>
