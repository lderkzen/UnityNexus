<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('banned_users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->timestamp('banned_at')->default(Carbon::now());
        });
    }

    public function down()
    {
        Schema::dropIfExists('banned_users');
    }
};
