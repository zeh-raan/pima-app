<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Test: php artisan app:update-missed-tasks
// Constant Monitoring : php artisan schedule:work
Schedule::command('app:update-missed-tasks')->everyMinute();