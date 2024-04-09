<?php

namespace Tests\Unit\Aggregates;

use App\Aggregates\UserWithLocation;
use App\Entities\LocationEntity;
use App\Entities\UserEntity;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

class UserWithLocationTest extends TestCase
{
    public function test_can_get_user_with_location_as_array(): UserWithLocation
    {
        // arrange
        $user = new UserEntity([
            'uuid' => '12345-xxxx-a1a1a1-qef0912',
            'gender' => 'male',
            'name' => [
                'title' => 'mr',
                'first' => 'john',
                'last' => 'doe'
            ],
            'dob' => [
                'date' => '2021-12-31T17:57:54.969Z',
                'age' => 30
            ],
        ]);
        $location = new LocationEntity([
            'city' => 'city',
            'state' => 'state',
            'street' => ['number' => 123, 'name' => 'street'],
            'country' => 'country',
            'postcode' => 'postcode',
            'coordinates' => ['latitude' => 123, 'longitude' => 123],
            'timezone' => ['offset' => '+7:00', 'description' => 'text'],
        ]);

        // act
        $aggregate = new UserWithLocation($user, $location);

        // assert
        $this->assertEquals([
            'uuid' => '12345-xxxx-a1a1a1-qef0912',
            'gender' => 'male',
            'name' => [
                'title' => 'mr',
                'first' => 'john',
                'last' => 'doe'
            ],
            'age' => 30,
            'location' => $location->toArray()
        ], $aggregate->toArray());

        return $aggregate;
    }

    #[Depends('test_can_get_user_with_location_as_array')]
    public function test_can_mutate_attribute_user(UserWithLocation $userWithLocation): void
    {
        // arrange
        $oldUser = $userWithLocation->getUser();

        // act
        $userWithLocation->setUser(new UserEntity([
            'uuid' => '12345-xxxx-a1a1a1-qef0912',
            'gender' => 'female',
            'name' => [
                'title' => 'mrs',
                'first' => 'jenny',
                'last' => 'bat'
            ],
            'dob' => [
                'date' => '2021-12-31T17:57:54.969Z',
                'age' => 25
            ],
        ]));

        // assert
        $this->assertNotEquals($oldUser->toArray(), $userWithLocation->getUser()->toArray());
    }

    #[Depends('test_can_get_user_with_location_as_array')]
    public function test_can_mutate_attribute_location(UserWithLocation $userWithLocation): void
    {
        // arrange
        $oldLocation = $userWithLocation->getUser();

        // act
        $userWithLocation->setLocation(new LocationEntity([
            'city' => 'new city',
            'state' => 'new state',
            'street' => ['number' => 123, 'name' => 'street'],
            'country' => 'new country',
            'postcode' => 'new postcode',
            'coordinates' => ['latitude' => 123, 'longitude' => 123],
            'timezone' => ['offset' => '+7:00', 'description' => 'text'],
        ]));

        // assert
        $this->assertNotEquals($oldLocation->toArray(), $userWithLocation->getLocation()->toArray());
    }
}
