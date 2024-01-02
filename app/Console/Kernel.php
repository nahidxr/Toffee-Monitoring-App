<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('send:channel-status-notifications')->everyThirtyMinutes();
        // $schedule->command('send:channel-status-notifications')->everyMinute();
        // $schedule->command('process:data')->everyMinute();
        // Run the command every five minutes
        $schedule->command('process:data')->everyFiveMinutes();


    }

  
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
