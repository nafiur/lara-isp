<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use App\Support\Tenancy\TenantContext;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Contracts\PermissionsTeamResolver;

class CoreSetupController extends Controller
{
    public function index(Request $request, TenantContext $context): View
    {
        $user = $request->user()
            ->load([
                'companies.branches' => fn ($query) => $query->orderBy('name'),
                'branches' => fn ($query) => $query->orderBy('name'),
            ]);

        $currentCompany = $context->company() ?? $user->companies->first();

        $branchesByCompany = $user->branches->groupBy('company_id');

        return view('setup.core', [
            'user' => $user,
            'companies' => $user->companies,
            'branchesByCompany' => $branchesByCompany,
            'currentCompany' => $currentCompany,
            'currentBranch' => $context->branch(),
        ]);
    }

    public function update(Request $request, TenantContext $context, PermissionsTeamResolver $teamResolver): RedirectResponse
    {
        $data = $request->validate([
            'company_id' => ['required', 'integer'],
            'branch_id' => ['nullable', 'integer'],
        ]);

        /** @var \App\Models\User $user */
        $user = $request->user();

        /** @var Company|null $company */
        $company = $user->companies()->whereKey($data['company_id'])->first();

        abort_if(blank($company), 403, __('You do not have access to the selected company.'));

        $branch = null;

        if (! empty($data['branch_id'])) {
            /** @var Branch|null $branch */
            $branch = $user->branches()
                ->where('company_id', $company->getKey())
                ->whereKey($data['branch_id'])
                ->first();

            abort_if(blank($branch), 403, __('You do not have access to the selected branch.'));
        }

        $context->setCompany($company);
        $context->setBranch($branch);

        $teamResolver->setPermissionsTeamId($company->getKey());

        return back()->with('status', __('Tenant context updated successfully.'));
    }
}
