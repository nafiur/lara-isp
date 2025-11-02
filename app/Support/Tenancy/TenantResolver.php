<?php

namespace App\Support\Tenancy;

use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class TenantResolver
{
    public function __construct(
        protected TenantContext $context
    ) {
    }

    public function resolve(Request $request, ?User $user = null): TenantContext
    {
        $user ??= $request->user();

        if (! $user) {
            $this->context->setCompany(null);
            $this->context->setBranch(null);

            return $this->context;
        }

        $company = $this->resolveCompany($request, $user);
        $this->context->setCompany($company);

        $branch = $this->resolveBranch($request, $user, $company);
        $this->context->setBranch($branch);

        return $this->context;
    }

    protected function resolveCompany(Request $request, User $user): ?Company
    {
        $companyId = $request->header('X-Company-ID')
            ?? $request->query('company')
            ?? session('tenant.company_id');

        $companies = $user->relationLoaded('companies')
            ? $user->companies
            : $user->companies()->get();

        if ($companyId) {
            $company = $companies->firstWhere('id', (int) $companyId);
            if ($company) {
                return $company;
            }
        }

        return $companies->first();
    }

    protected function resolveBranch(Request $request, User $user, ?Company $company): ?Branch
    {
        if (! $company) {
            return null;
        }

        $branchId = $request->header('X-Branch-ID')
            ?? $request->query('branch')
            ?? session('tenant.branch_id');

        $branches = $user->relationLoaded('branches')
            ? $user->branches
            : $user->branches()->get();

        $branches = $branches->where('company_id', $company->getKey());

        if ($branchId) {
            $branch = $branches->firstWhere('id', (int) $branchId);
            if ($branch) {
                return $branch;
            }
        }

        return $branches->first() ?? $company->branches()->whereHas('users', fn ($query) => $query->whereKey($user->getKey()))->first();
    }
}
