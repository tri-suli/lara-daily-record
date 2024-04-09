<?php

namespace Tests\Feature\Services;

use App\Aggregates\UserWithLocation;
use App\Models\User;
use App\Services\ApiService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ApiServiceTest extends TestCase
{
    public function test_should_get_20_random_users(): void
    {
        // arrange
        $users = User::factory(20)->make();
        Http::fake([
            sprintf('%s/?results=20', config('app.api.random_user')) => Http::response([
                'results' => $users->toArray(),
            ])
        ]);
        $api = new ApiService();

        // act
        $result = $api->fetchUsers();

        // assert
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(20, $result);
        $result->each(function ($r) {
            $this->assertInstanceOf(UserWithLocation::class, $r);
        });
    }
}
