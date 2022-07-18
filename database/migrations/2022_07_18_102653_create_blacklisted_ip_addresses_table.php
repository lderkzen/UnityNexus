<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blacklisted_ip_addresses', function (Blueprint $table) {
            $table->ipAddress()->primary();
            $table->timestamp('blacklisted_at')->default(Carbon::now());
        });
    }

    public function down()
    {
        Schema::dropIfExists('blacklisted_ip_addresses');
    }
};
