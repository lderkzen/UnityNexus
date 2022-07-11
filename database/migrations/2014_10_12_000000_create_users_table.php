<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('username', 255);
            $table->unsignedInteger('discriminator');
            $table->string('avatar', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
