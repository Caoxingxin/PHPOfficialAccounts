<?php

namespace App\Console;

use App\Console\Commands\TempYxl;
use App\Console\Commands\Test;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        TempYxl::class
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('test')->everyMinute();
        // $schedule->command('inspire')
        //          ->hourly();
        //$schedule->command('command:TempYxl')->everyMinute()->withoutOverlapping;
        $schedule->command('command:TempYxl')->dailyAt('09:00')->withoutOverlapping;

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
