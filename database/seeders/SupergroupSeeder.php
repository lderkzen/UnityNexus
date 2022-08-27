<?php

namespace Database\Seeders;

use App\Models\Supergroup;
use Illuminate\Database\Seeder;

class SupergroupSeeder extends Seeder
{
    public function run()
    {
        Supergroup::create([
            'name' => 'Ungrouped',
            'position' => 0
        ]);
    }
}
