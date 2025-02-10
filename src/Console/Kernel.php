<?php

namespace ThachVd\LaravelSiteControllerApi\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sc-api:generate-models')->runInBackground();
    }
}
