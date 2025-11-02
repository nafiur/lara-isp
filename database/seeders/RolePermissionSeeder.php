<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    protected const GUARD = 'web';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // crm
            'crm.view',
            'crm.manage',
            // billing
            'billing.view',
            'billing.manage',
            'billing.invoices.generate',
            'billing.payments.reconcile',
            // network
            'network.view',
            'network.manage',
            'network.provision',
            // inventory
            'inventory.view',
            'inventory.manage',
            // support
            'support.view',
            'support.manage',
            // reporting
            'reporting.view',
        ];

        collect($permissions)->each(function (string $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => self::GUARD],
                []
            );
        });

        $roleMatrix = [
            'super-admin' => $permissions,
            'operations-manager' => [
                'crm.view',
                'crm.manage',
                'billing.view',
                'billing.invoices.generate',
                'inventory.view',
                'inventory.manage',
                'support.view',
                'support.manage',
                'reporting.view',
            ],
            'billing-operator' => [
                'billing.view',
                'billing.manage',
                'billing.invoices.generate',
                'billing.payments.reconcile',
                'reporting.view',
            ],
            'network-engineer' => [
                'network.view',
                'network.manage',
                'network.provision',
                'reporting.view',
            ],
            'support-agent' => [
                'crm.view',
                'support.view',
                'support.manage',
            ],
            'read-only' => [
                'crm.view',
                'billing.view',
                'network.view',
                'inventory.view',
                'support.view',
                'reporting.view',
            ],
        ];

        foreach ($roleMatrix as $roleName => $assignedPermissions) {
            $role = Role::firstOrCreate(
                ['name' => $roleName, 'guard_name' => self::GUARD],
                []
            );

            $role->syncPermissions($assignedPermissions);
        }
    }
}
