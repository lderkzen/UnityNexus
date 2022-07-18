<?php

namespace Database\Seeders;

use App\Models\PermissionFlag;
use Illuminate\Database\Seeder;

class PermissionFlagSeeder extends Seeder
{
    public function run()
    {
        PermissionFlag::create([
            'flag' => 'PERMISSIONS.EDIT'
        ]);

        PermissionFlag::create([
            'flag' => 'GROUPS.CREATE'
        ]);

        PermissionFlag::create([
            'flag' => 'GROUPS.EDIT'
        ]);

        PermissionFlag::create([
            'flag' => 'GROUPS.DELETE'
        ]);

        PermissionFlag::create([
            'flag' => 'SUPERGROUPS.CREATE'
        ]);

        PermissionFlag::create([
            'flag' => 'SUPERGROUPS.EDIT'
        ]);

        PermissionFlag::create([
            'flag' => 'SUPERGROUPS.DELETE'
        ]);

        PermissionFlag::create([
            'flag' => 'APPLICATION_SUBMISSIONS.VIEW_PRIVATE_SUBMISSIONS'
        ]);

        PermissionFlag::create([
            'flag' => 'APPLICATION_SUBMISSIONS.ASSIGN_MEMBER'
        ]);

        PermissionFlag::create([
            'flag' => 'APPLICATION_SUBMISSIONS.UPDATE_STATUS'
        ]);

        PermissionFlag::create([
            'flag' => 'APPLICATION_SUBMISSIONS.TRANSFER_GROUP'
        ]);

        PermissionFlag::create([
            'flag' => 'MEMBERS.BAN'
        ]);

        PermissionFlag::create([
            'flag' => 'IP_ADDRESSES.BAN'
        ]);

        PermissionFlag::create([
            'flag' => 'BANS.MANAGE'
        ]);

        PermissionFlag::create([
            'flag' => 'BLACKLISTED_IP_ADDRESSES.MANAGE'
        ]);
    }
}
