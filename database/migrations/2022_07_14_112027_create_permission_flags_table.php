<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permission_flags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('permission_flags');
    }
};
