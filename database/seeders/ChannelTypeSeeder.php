<?php

namespace Database\Seeders;

use App\Models\ChannelType;
use Illuminate\Database\Seeder;

class ChannelTypeSeeder extends Seeder
{
    public function run()
    {
        ChannelType::insert([
            ['id' => 0, 'type' => 'GUILD_TEXT'],
            ['id' => 1, 'type' => 'DM'],
            ['id' => 2, 'type' => 'GUILD_VOICE'],
            ['id' => 3, 'type' => 'GROUP_DM'],
            ['id' => 4, 'type' => 'GUILD_CATEGORY'],
            ['id' => 5, 'type' => 'GUILD_NEWS'],
            ['id' => 10, 'type' => 'GUILD_NEWS_THREAD'],
            ['id' => 11, 'type' => 'GUILD_PUBLIC_THREAD'],
            ['id' => 12, 'type' => 'GUILD_PRIVATE_THREAD'],
            ['id' => 13, 'type' => 'GUILD_STAGE_VOICE'],
            ['id' => 14, 'type' => 'GUILD_DIRECTORY'],
        ]);
    }
}
