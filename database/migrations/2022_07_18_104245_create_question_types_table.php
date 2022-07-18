<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('question_types', function (Blueprint $table) {
            $table->string('type', 255)->primary();
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_types');
    }
};
