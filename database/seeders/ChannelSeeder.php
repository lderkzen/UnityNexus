<?php

namespace Database\Seeders;

use App\Http\Facades\Discord;
use App\Models\Channel;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    public function run()
    {
        $channels = Discord::GetGuildChannels(config('app.discord_server_id'))->json();
        array_multisort(array_column($channels, 'parent_id'), SORT_ASC, $channels);

        foreach ($channels as $channel) {
            Channel::create([
                'id' => $channel['id'],
                'type_id' => $channel['type'],
                'name' => $channel['name'],
                'parent_id' => $channel['parent_id']
            ]);
        }
    }
}
