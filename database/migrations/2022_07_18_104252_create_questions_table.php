<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('groups')
                ->cascadeOnDelete();
            $table->foreignId('type_id')->constrained('question_types')
                ->cascadeOnDelete();
            $table->unsignedTinyInteger('position');
            $table->string('question', 255);
            $table->string('hint', 255)->nullable();
            $table->json('validation_rules')->default(json_encode(['required']));
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
