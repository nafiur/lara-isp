<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class PromoteSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:promote-super-admin {user_id : The ID of the user to promote}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign the global super-admin role to a user.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $userId = (int) $this->argument('user_id');
        /** @var User|null $user */
        $user = User::find($userId);

        if (! $user) {
            $this->error("User with ID {$userId} not found.");

            return self::FAILURE;
        }

        $role = Role::firstOrCreate([
            'name' => 'super-admin',
            'guard_name' => 'web',
        ]);

        $user->assignRole($role);

        $this->info("User {$user->id} ({$user->email}) promoted to super-admin.");

        return self::SUCCESS;
    }
}
