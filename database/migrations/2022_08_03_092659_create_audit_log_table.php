<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('audit_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')
                ->nullOnDelete();
            $table->string('entry', 255);
            $table->timestamp('created_at')->default(Carbon::now());
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_log');
    }
};
