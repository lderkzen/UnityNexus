<?php

namespace Database\Seeders;

use App\Http\Facades\Discord;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $res = Discord::GetGuild(config('app.discord_server_id'))->json();

        foreach ($res['roles'] as $role) {
            if ($role['name'] !== '@everyone')
                Role::create([
                    'id' => $role['id'],
                    'name' => $role['name'],
                    'position' => $role['position']
                ]);
        }
    }
}
