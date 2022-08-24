<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Deletes all avatar pictures daily at midnight.
        $schedule->call(function () {
            $avatars = Storage::files('public/avatars');
            Storage::delete($avatars);
        })->dailyAt('03:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
