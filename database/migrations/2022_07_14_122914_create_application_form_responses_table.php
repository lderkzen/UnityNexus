<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('application_form_responses', function (Blueprint $table) {
            $table->id();
            $table->jsonb('response');
            $table->boolean('accepted')->nullable();
            $table->foreignId('application_form_id')->constrained('application_forms');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('assigned_user_id')->nullable()->constrained('users');
            $table->timestamp('created_at')->default(Carbon::now());
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('application_form_responses');
    }
};
