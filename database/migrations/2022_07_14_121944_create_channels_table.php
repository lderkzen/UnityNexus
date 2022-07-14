<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedTinyInteger('type_id');
            $table->foreign('type_id')->references('id')->on('channel_types');
            $table->string('name', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('channels');
    }
};
