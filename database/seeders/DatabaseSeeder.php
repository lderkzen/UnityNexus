<?php

namespace Database\Seeders;

use App\Models\PermissionFlag;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed lookup tables.
        $this->call(ChannelTypeSeeder::class);
        $this->call(PermissionFlagSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(QuestionTypeSeeder::class);

        // Seed Discord data.
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ChannelSeeder::class);

        // Set up permissions for the admin role.
        if ($role = Role::find(env('DISCORD_SUPERADMIN_ROLE')))
            $role->PermissionFlags()->sync(PermissionFlag::all()->only('id')->toArray());
    }
}
