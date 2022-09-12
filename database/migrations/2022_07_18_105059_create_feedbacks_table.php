<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('answer_id')->constrained('answers')
                ->cascadeOnDelete();
            $table->string('feedback');
            $table->timestamp('created_at')->default(Carbon::now());
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedback');
    }
};
