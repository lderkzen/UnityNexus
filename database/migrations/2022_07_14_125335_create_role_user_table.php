<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained('roles');
            $table->foreignId('user_id')->constrained('users');
            $table->primary(['role_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_user');
    }
};
