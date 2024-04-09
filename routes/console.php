<?php

use App\Jobs\ProcessingUserRecordDaily;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:fetch-random-users')->hourly();
Schedule::job(new ProcessingUserRecordDaily())->dailyAt('23:59');
