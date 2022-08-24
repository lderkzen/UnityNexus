<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_submission_id')->constrained('application_submissions')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('question_id')->nullable();
            $table->string('question', 255);
            $table->string('answer');
        });
    }

    public function down()
    {
        Schema::dropIfExists('answers');
    }
};
