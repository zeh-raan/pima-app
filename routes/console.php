<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Test manually:
// php artisan tasks:update-missed

// Run scheduler:
// php artisan schedule:work

Schedule::command('tasks:update-missed')->everyMinute();