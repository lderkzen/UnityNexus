<?php

namespace Database\Seeders;

use App\Http\Facades\Discord;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $guild = Discord::GetGuild(config('app.discord_server_id'))->json();

        $data = [];
        foreach ($guild['roles'] as $role) {
            if ($role['name'] !== '@everyone')
                $data[] = [
                    'id' => $role['id'],
                    'name' => $role['name'],
                    'position' => $role['position']
                ];
        }
        Role::insert($data);
    }
}
