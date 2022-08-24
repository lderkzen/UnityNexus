<?php

namespace Database\Seeders;

use App\Models\QuestionType;
use Illuminate\Database\Seeder;

class QuestionTypeSeeder extends Seeder
{
    public function run()
    {
        QuestionType::insert([
            ['type' => 'text'],
            ['type' => 'number'],
            ['type' => 'checkbox']
        ]);
    }
}
