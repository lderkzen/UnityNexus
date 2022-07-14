<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->foreignId('supergroup_id')->nullable()->constrained('supergroups');
            $table->foreignId('application_form_id')->constrained('application_forms');
            $table->foreignId('notification_channel_id')->constrained('channels');
            $table->boolean('recruiting')->default(true);
            $table->timestamp('created_at')->default(Carbon::now());
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups');
    }
};
