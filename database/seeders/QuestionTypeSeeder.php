<?php

namespace Database\Seeders;

use App\Models\QuestionType;
use Illuminate\Database\Seeder;

class QuestionTypeSeeder extends Seeder
{
    public function run()
    {
        QuestionType::create([
            'type' => 'text'
        ]);

        QuestionType::create([
            'type' => 'number'
        ]);

        QuestionType::create([
            'type' => 'checkbox'
        ]);
    }
}
