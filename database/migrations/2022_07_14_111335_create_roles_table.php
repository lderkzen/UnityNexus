<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('name', 255);
            $table->smallInteger('position');
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
