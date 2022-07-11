<?php

namespace App\Providers;

use App\Http\Facades\Discord;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class BotServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('discord', function () {
            return new Discord();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
