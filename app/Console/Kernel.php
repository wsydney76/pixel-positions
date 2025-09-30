<?php

namespace App\Console;

use App\Console\Commands\CleanupTags;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        CleanupTags::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Define scheduled tasks here
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}

