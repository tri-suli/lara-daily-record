<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Aggregates\UserWithLocation;
use Illuminate\Support\Collection;

interface ApiContract
{
    /**
     * @param int $count
     * @return Collection<int, UserWithLocation>
     */
    public function fetchUsers(int $count = 20): Collection;
}
