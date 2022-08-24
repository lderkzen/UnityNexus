<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('application_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('groups')
                ->cascadeOnDelete();
            $table->foreignId('applicant_id')->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('assigned_id')->nullable()->constrained('users')
                ->nullOnDelete();
            $table->foreignId('status_id')->constrained('statuses')
                ->cascadeOnDelete();
            $table->boolean('public')->default(false);
            $table->unsignedTinyInteger('age');
            $table->string('location');
            $table->timestamp('refinement_since')->nullable();
            $table->unsignedTinyInteger('attempts')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('application_submissions');
    }
};
