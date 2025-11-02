<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\PermissionsTeamResolver;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;

class TenantPromoteSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:promote-super-admin {user_id : The ID of the user to promote} {--company= : Optional company ID to scope the role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign the super-admin role to a user, optionally scoped to a specific company.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $userId = (int) $this->argument('user_id');
        $companyId = $this->option('company');
        $companyId = $companyId !== null ? (int) $companyId : null;

        /** @var User|null $user */
        $user = User::find($userId);

        if (! $user) {
            $this->error("User with ID {$userId} not found.");

            return self::FAILURE;
        }

        if ($companyId === null) {
            $companyId = $user->companies()->orderByDesc('company_user.is_owner')->value('companies.id') ?? 0;
        }

        /** @var PermissionsTeamResolver $teamResolver */
        $teamResolver = app(PermissionsTeamResolver::class);
        $teamResolver->setPermissionsTeamId($companyId);

        $roleAttributes = [
            'name' => 'super-admin',
            'guard_name' => 'web',
            'company_id' => $companyId,
        ];

        $role = Role::firstOrCreate($roleAttributes);

        DB::table('model_has_roles')->updateOrInsert([
            'role_id' => $role->getKey(),
            'model_type' => $user::class,
            'model_id' => $user->getKey(),
            'company_id' => $companyId,
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $scopeLabel = $companyId === 0
            ? 'global scope (company_id = 0)'
            : "company ID {$companyId}";

        $this->info("User {$user->id} ({$user->email}) promoted to super-admin for {$scopeLabel}.");

        return self::SUCCESS;
    }
}
