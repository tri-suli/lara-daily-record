<?php

namespace App\Jobs;

use App\Models\DailyRecord;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class ProcessingUserRecordDaily implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $maleCount = Redis::hmget('hourly_record', 'male:count')[0];
        $femaleCount = Redis::hmget('hourly_record', 'female:count')[0];

        $maleAvgAge = User::where('gender', 'male')->avg('age');
        $femaleAvgAge = User::where('gender', 'female')->avg('age');

        $today = now()->toDateString();
        DailyRecord::updateOrCreate(
            ['date' => $today],
            [
                'date' => $today,
                'male_count' => $maleCount,
                'female_count' => $femaleCount,
                'male_avg_age' => round(floatval($maleAvgAge)),
                'female_avg_age' => round(floatval($femaleAvgAge))
            ]
        );
    }
}
