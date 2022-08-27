<?php

namespace Database\Seeders;

use App\Http\Facades\Discord;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $members = Discord::GetGuildMembers(config('app.discord_server_id'))->json();

        foreach ($members as $member) {
            if (!isset($member['user']['bot'])) {
                User::create([
                    'id' => $member['user']['id'],
                    'username' => $member['user']['username'],
                    'discriminator' => $member['user']['discriminator'],
                    'joined_at' => $member['joined_at'],
                    'avatar' => $member['user']['avatar'] ?? null
                ]);
                if (count($member['roles']) > 0)
                    User::find($member['user']['id'])->roles()->sync($member['roles']);
            }
        }
    }
}
