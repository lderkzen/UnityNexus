<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permission_flag_role', function (Blueprint $table) {
            $table->foreignId('permission_flag_id')->constrained('permission_flags');
            $table->foreignId('role_id')->constrained('roles');
            $table->timestamp('attached_at')->default(Carbon::now());
            $table->primary(['permission_flag_id', 'role_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('permission_flag_role');
    }
};
