<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('channel_types', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('type', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('channel_types');
    }
};
