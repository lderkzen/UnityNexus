<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run()
    {
        Status::insert([
            ['status' => 'PENDING'],
            ['status' => 'REFINEMENT'],
            ['status' => 'ACCEPTED'],
            ['status' => 'REJECTED'],
        ]);
    }
}
