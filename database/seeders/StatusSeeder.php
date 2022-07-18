<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run()
    {
        Status::create([
            'status' => 'PENDING'
        ]);

        Status::create([
            'status' => 'REFINEMENT'
        ]);

        Status::create([
            'status' => 'ACCEPTED'
        ]);

        Status::create([
            'status' => 'REJECTED'
        ]);
    }
}
