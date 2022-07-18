<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permission_flag_role', function (Blueprint $table) {
            $table->unsignedTinyInteger('permission_flag_id');
            $table->foreign('permission_flag_id')->references('id')->on('permission_flags')
                ->cascadeOnDelete();
            $table->foreignId('role_id')->constrained('roles')
                ->cascadeOnDelete();

            $table->primary(['permission_flag_id', 'role_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('permission_flag_role');
    }
};
