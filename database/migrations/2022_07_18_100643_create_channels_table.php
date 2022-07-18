<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('type_id');
            $table->foreign('type_id')->references('id')->on('channel_types')
                ->cascadeOnDelete();
            $table->string('name', 255);
        });

        Schema::table('channels', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->constrained('channels')
                ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('channels');
    }
};
