<?php

namespace App\Console\Commands;

use App\Aggregates\UserWithLocation;
use App\Models\User;
use App\Services\ApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class FetchRandomUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-random-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch user records from API and store in database';

    private ApiService $apiService;

    public function __construct(ApiService $apiService)
    {
        parent::__construct();
        $this->apiService = $apiService;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $users = $this->apiService->fetchUsers();

        $users->each(function (UserWithLocation $user) {
            User::createUser($user);
        });

        $maleCount = User::countMale();
        $femaleCount = User::countFemale();
        Redis::hmset('hourly_record', [
            'male:count' => $maleCount,
            'female:count' => $femaleCount,
        ]);

        $this->info('User records fetched and stored successfully.');
    }
}
