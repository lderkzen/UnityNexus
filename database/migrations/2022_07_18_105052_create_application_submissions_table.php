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
            $table->foreignId('assigned_user_id')->nullable()->constrained('users')
                ->nullOnDelete();
            $table->string('status', 255);
            $table->foreign('status')->references('status')->on('statuses')
                ->cascadeOnDelete();
            $table->timestamp('refinement_since')->nullable();
            $table->boolean('public')->default(false);
            $table->unsignedTinyInteger('attempts')->default(1);
            $table->timestamps();
            $table->timestamp('answered_at')->default(Carbon::now());
            $table->timestamp('answers_updated_at')->nullable();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('application_submissions');
    }
};
