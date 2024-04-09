<?php

namespace Tests\Unit\Entities;

use App\Entities\LocationEntity;
use App\ValueObjects\AssocValue;
use App\ValueObjects\NumericValue;
use App\ValueObjects\TextValue;
use PHPUnit\Framework\TestCase;

class LocationEntityTest extends TestCase
{
    public function test_can_mutate_location_city(): void
    {
        // arrange
        $oldValue = 'city';
        $newValue = 'new city';

        // act
        $entity = new LocationEntity([
            'city' => $oldValue,
            'state' => 'state',
            'street' => ['number' => 123, 'name' => 'street'],
            'country' => 'country',
            'postcode' => 'postcode',
            'coordinates' => ['latitude' => 123, 'longitude' => 123],
            'timezone' => ['offset' => '+7:00', 'description' => 'text'],
        ]);
        $entity->setCity($newValue);

        // assert
        $this->assertInstanceOf(TextValue::class, $entity->city);
        $this->assertNotEquals($oldValue, $entity->getCity());
        $this->assertEquals($newValue, $entity->getCity());
    }

    public function test_can_mutate_location_state(): void
    {
        // arrange
        $oldValue = 'state';
        $newValue = 'new state';

        // act
        $entity = new LocationEntity([
            'city' => 'city',
            'state' => $oldValue,
            'street' => ['number' => 123, 'name' => 'street'],
            'country' => 'country',
            'postcode' => 'postcode',
            'coordinates' => ['latitude' => 123, 'longitude' => 123],
            'timezone' => ['offset' => '+7:00', 'description' => 'text'],
        ]);
        $entity->setState($newValue);

        // assert
        $this->assertInstanceOf(TextValue::class, $entity->state);
        $this->assertNotEquals($oldValue, $entity->getState());
        $this->assertEquals($newValue, $entity->getState());
    }

    public function test_can_mutate_location_country(): void
    {
        // arrange
        $oldValue = 'country';
        $newValue = 'new country';

        // act
        $entity = new LocationEntity([
            'city' => 'city',
            'state' => 'state',
            'street' => ['number' => 123, 'name' => 'street'],
            'country' => $oldValue,
            'postcode' => 'postcode',
            'coordinates' => ['latitude' => 123, 'longitude' => 123],
            'timezone' => ['offset' => '+7:00', 'description' => 'text'],
        ]);
        $entity->setCountry($newValue);

        // assert
        $this->assertInstanceOf(TextValue::class, $entity->country);
        $this->assertNotEquals($oldValue, $entity->getCountry());
        $this->assertEquals($newValue, $entity->getCountry());
    }

    public function test_can_mutate_location_postcode(): void
    {
        // arrange
        $oldValue = 12345;
        $newValue = '678910';

        // act
        $entity = new LocationEntity([
            'city' => 'city',
            'state' => 'state',
            'street' => ['number' => 123, 'name' => 'street'],
            'country' => 'country',
            'postcode' => $oldValue,
            'coordinates' => ['latitude' => 123, 'longitude' => 123],
            'timezone' => ['offset' => '+7:00', 'description' => 'text'],
        ]);
        $entity->setPostcode($newValue);

        // assert
        $this->assertInstanceOf(NumericValue::class, $entity->postcode);
        $this->assertNotEquals($oldValue, $entity->getPostcode());
        $this->assertEquals(678910, $entity->getPostcode());
    }

    public function test_can_mutate_location_street(): void
    {
        // arrange
        $oldValue = [
            'number' => 7430,
            'name' => 'Goethestraße'
        ];
        $newValue = [
            'number' => 12345,
            'name' => 'new street'
        ];

        // act
        $entity = new LocationEntity([
            'city' => 'city',
            'state' => 'state',
            'street' => $oldValue,
            'country' => 'country',
            'postcode' => 'postcode',
            'coordinates' => ['latitude' => 123, 'longitude' => 123],
            'timezone' => ['offset' => '+7:00', 'description' => 'text'],
        ]);
        $entity->setStreet($newValue);

        // assert
        $this->assertInstanceOf(AssocValue::class, $entity->street);
        $this->assertNotEquals($oldValue, $entity->getStreet());
        $this->assertEquals($newValue, $entity->getStreet());
    }

    public function test_can_mutate_location_coordinates(): void
    {
        // arrange
        $oldValue = ['latitude' => 123, 'longitude' => 123];
        $newValue = ['latitude' => 456, 'longitude' => 789];

        // act
        $entity = new LocationEntity([
            'city' => 'city',
            'state' => 'state',
            'street' => ['number' => 123, 'name' => 'street'],
            'country' => 'country',
            'postcode' => 'postcode',
            'coordinates' => $oldValue,
            'timezone' => ['offset' => '+7:00', 'description' => 'text'],
        ]);
        $entity->setCoordinates($newValue);

        // assert
        $this->assertInstanceOf(AssocValue::class, $entity->coordinates);
        $this->assertNotEquals($oldValue, $entity->getCoordinates());
        $this->assertEquals($newValue, $entity->getCoordinates());
    }

    public function test_can_mutate_location_timezone(): void
    {
        // arrange
        $oldValue = ['offset' => '+7:00', 'description' => 'text'];
        $newValue = ['offset' => '-8:00', 'description' => 'hello world'];

        // act
        $entity = new LocationEntity([
            'city' => 'city',
            'state' => 'state',
            'street' => ['number' => 123, 'name' => 'street'],
            'country' => 'country',
            'postcode' => 'postcode',
            'coordinates' => ['latitude' => 123, 'longitude' => 123],
            'timezone' => $oldValue,
        ]);
        $entity->setTimezone($newValue);

        // assert
        $this->assertInstanceOf(AssocValue::class, $entity->timezone);
        $this->assertNotEquals($oldValue, $entity->getTimezone());
        $this->assertEquals($newValue, $entity->getTimezone());
    }

    public function test_can_transform_location_entity_as_array(): void
    {
        // arrange
        $attributes = [
            'street' => [
                'number' => 7430,
                'name' => 'Goethestraße'
            ],
            'city' => 'Homberg (Efze)',
            'state' => 'Schleswig-Holstein',
            'country' => 'Germany',
            'postcode' => 68865,
            'coordinates' => [
                'latitude' => '-47.2423',
                'longitude' => '-77.0423'
            ],
            'timezone' => [
                'offset' => '+8:00',
                'description' => 'Beijing, Perth, Singapore, Hong Kong'
            ]
        ];

        // act
        $entity = new LocationEntity($attributes);

        // assert
        $this->assertEquals($attributes, $entity->toArray());
    }
}
