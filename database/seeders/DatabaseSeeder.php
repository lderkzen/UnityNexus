<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed lookup tables.
        $this->call(ChannelTypeSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(QuestionTypeSeeder::class);

        // Seed Discord data.
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ChannelSeeder::class);
    }
}
