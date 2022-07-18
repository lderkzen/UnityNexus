<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('application_submission_question', function (Blueprint $table) {
            $table->foreignId('application_submission_id')->constrained('application_submissions')
                ->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('questions')
                ->cascadeOnDelete();
            $table->primary(['application_submission_id', 'question_id']);
            $table->string('answer');
            $table->string('feedback')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('application_submission_question');
    }
};
