<?php

declare(strict_types=1);

namespace App\Services;

use App\Aggregates\UserWithLocation;
use App\Contracts\ApiContract;
use App\Entities\LocationEntity;
use App\Entities\UserEntity;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class ApiService implements ApiContract
{
    /**
     * Base api url
     *
     * @var string
     */
    public string $baseUrl;

    /**
     * Create a new api service instance
     */
    public function __construct()
    {
        $this->baseUrl = config('app.api.random_user');
    }

    /**
     * {@inheritDoc}
     */
    public function fetchUsers(int $count = 20): Collection
    {
        $response = Http::baseUrl($this->baseUrl)->get("?results=$count");
        $items = Collection::make($response->collect()->get('results'));

        return $items->transform(function (array $item) {
            return new UserWithLocation(
                new UserEntity([
                    'uuid' => $item['login']['uuid'],
                    'name' => $item['name'],
                    'dob' => $item['dob'],
                    'gender' => $item['gender']
                ]),
                new LocationEntity($item['location'])
            );
        });
    }
}
