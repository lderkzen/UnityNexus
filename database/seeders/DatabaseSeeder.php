<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed lookup tables.
        $this->call(ChannelTypeSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(QuestionTypeSeeder::class);
        $this->call(SupergroupSeeder::class);

        // Seed Discord data.
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ChannelSeeder::class);

        // TODO: Remove temporary test data below.
        $groups = Group::factory(3)->create([
            'channel_id' => 585095736773967884
        ]);
        foreach ($groups as $group) {
            Question::factory(10)->create([
                'group_id' => $group->id
            ]);
        }
    }
}
