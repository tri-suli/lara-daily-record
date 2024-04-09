<?php

declare(strict_types=1);

namespace App\Aggregates;

use App\Entities\LocationEntity;
use App\Entities\UserEntity;
use Illuminate\Contracts\Support\Arrayable;

class UserWithLocation implements Arrayable
{
    /**
     * Represents user entity object
     *
     * @var UserEntity
     */
    private UserEntity $user;

    /**
     * Represents location entity object
     *
     * @var LocationEntity
     */
    private LocationEntity $location;

    /**
     * Create a new aggregate instance.
     *
     * @param UserEntity $user The UserEntity instance to set.
     * @param LocationEntity $location The LocationEntity instance to set.
     *
     * @return void
     */
    public function __construct(UserEntity $user, LocationEntity $location)
    {
        $this->setUser($user);
        $this->setLocation($location);
    }

    /**
     * Retrieve the UserEntity associated with this instance.
     *
     * @return UserEntity The UserEntity associated with this instance.
     */
    public function getUser(): UserEntity
    {
        return $this->user;
    }

    /**
     * Set the user for the current object.
     *
     * @param UserEntity $user The UserEntity object to set.
     *
     * @return void
     */
    public function setUser(UserEntity $user): void
    {
        $this->user = $user;
    }

    /**
     * Get the location entity.
     *
     * @return LocationEntity The location entity.
     */
    public function getLocation(): LocationEntity
    {
        return $this->location;
    }

    /**
     * Set the location for the application.
     *
     * @param LocationEntity $location The location entity to set
     * @return void
     */
    public function setLocation(LocationEntity $location): void
    {
        $this->location = $location;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $user = $this->getUser()->toArray();

        $user['age'] = $this->getUser()->dob->age();
        unset($user['dob']);

        return array_merge($user, [
            'location' => $this->getLocation()->toArray()
        ]);
    }
}
