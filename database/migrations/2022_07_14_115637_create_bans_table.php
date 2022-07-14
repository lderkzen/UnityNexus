<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->ipAddress()->nullable();
            $table->timestamp('banned_at')->default(Carbon::now());
        });
    }

    public function down()
    {
        Schema::dropIfExists('bans');
    }
};
