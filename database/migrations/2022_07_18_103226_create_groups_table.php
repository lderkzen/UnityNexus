<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supergroup_id')->default(1)->constrained('supergroups')
                ->nullOnDelete();
            $table->foreignId('channel_id')->nullable()->constrained('channels')
                ->nullOnDelete();
            $table->string('name', 255);
            $table->string('description')->nullable();
            $table->boolean('recruiting')->default(true);
            $table->unsignedTinyInteger('position');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups');
    }
};
