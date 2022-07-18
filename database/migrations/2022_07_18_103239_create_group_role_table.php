<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('group_role', function (Blueprint $table) {
            $table->foreignId('group_id')->constrained('groups')
                ->cascadeOnDelete();
            $table->foreignId('role_id')->constrained('roles')
                ->cascadeOnDelete();
            $table->boolean('can_edit')->default('false');
            $table->primary(['group_id', 'role_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('group_role');
    }
};
