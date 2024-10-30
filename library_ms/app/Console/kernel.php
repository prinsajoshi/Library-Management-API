<?php

namespace App\Console;

use App\Console\Commands\CheckBookSubmissions; // Make sure this matches your command
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Register your command here
        CheckBookSubmissions::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // This should be set to run at the desired frequency
        $schedule->command('books:check-submissions')->everyFifteenMinutes(); // Change frequency to your need
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
