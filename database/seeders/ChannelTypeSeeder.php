<?php

namespace Database\Seeders;

use App\Models\ChannelType;
use Illuminate\Database\Seeder;

class ChannelTypeSeeder extends Seeder
{
    public function run()
    {
        ChannelType::create([
            'id' => 0,
            'type' => 'GUILD_TEXT'
        ]);

        ChannelType::create([
            'id' => 1,
            'type' => 'DM'
        ]);

        ChannelType::create([
            'id' => 2,
            'type' => 'GUILD_VOICE'
        ]);

        ChannelType::create([
            'id' => 3,
            'type' => 'GROUP_DM'
        ]);

        ChannelType::create([
            'id' => 4,
            'type' => 'GUILD_CATEGORY'
        ]);

        ChannelType::create([
            'id' => 5,
            'type' => 'GUILD_NEWS'
        ]);

        ChannelType::create([
            'id' => 10,
            'type' => 'GUILD_NEWS_THREAD'
        ]);

        ChannelType::create([
            'id' => 11,
            'type' => 'GUILD_PUBLIC_THREAD'
        ]);

        ChannelType::create([
            'id' => 12,
            'type' => 'GUILD_PRIVATE_THREAD'
        ]);

        ChannelType::create([
            'id' => 13,
            'type' => 'GUILD_STAGE_VOICE'
        ]);

        ChannelType::create([
            'id' => 14,
            'type' => 'GUILD_DIRECTORY'
        ]);
    }
}
