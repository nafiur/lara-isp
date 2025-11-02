<?php

namespace App\Support\Tenancy;

use App\Models\Branch;
use App\Models\Company;

class TenantContext
{
    protected ?Company $company = null;

    protected ?Branch $branch = null;

    public function company(): ?Company
    {
        return $this->company;
    }

    public function branch(): ?Branch
    {
        return $this->branch;
    }

    public function setCompany(?Company $company): void
    {
        $this->company = $company;

        if ($company === null) {
            session()->forget('tenant.company_id');
        } else {
            session(['tenant.company_id' => $company->getKey()]);
        }
    }

    public function setBranch(?Branch $branch): void
    {
        $this->branch = $branch;

        if ($branch === null) {
            session()->forget('tenant.branch_id');
        } else {
            session(['tenant.branch_id' => $branch->getKey()]);
        }
    }
}
