<?php

namespace App\Http\Middleware;

use App\Support\Tenancy\TenantContext;
use App\Support\Tenancy\TenantResolver;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Contracts\PermissionsTeamResolver;

class ResolveTenancy
{
    public function __construct(
        protected TenantResolver $resolver,
        protected TenantContext $context,
        protected PermissionsTeamResolver $teamResolver,
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->resolver->resolve($request);

        app()->instance(TenantContext::class, $this->context);

        $request->attributes->set('tenant', $this->context);

        $this->teamResolver->setPermissionsTeamId($this->context->company()?->getKey());

        View::share('tenant', $this->context);
        View::share('tenantCompany', $this->context->company());
        View::share('tenantBranch', $this->context->branch());

        return $next($request);
    }
}
