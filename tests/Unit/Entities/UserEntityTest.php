<?php

namespace Tests\Unit\Entities;

use App\Entities\UserEntity;
use App\ValueObjects\AssocValue;
use App\ValueObjects\Attributes\DateOfBirthValue;
use App\ValueObjects\Attributes\FullNameValue;
use App\ValueObjects\NumericValue;
use App\ValueObjects\TextValue;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function test_can_mutate_user_uuid(): void
    {
        // arrange
        $oldValue = '12345-xxxx-a1a1a1-qef0912';
        $newValue = '123as-asdf9-oasf0a-ahf012';

        // act
        $entity = new UserEntity([
            'uuid' => $oldValue,
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
        $entity->setUUID($newValue);

        // assert
        $this->assertInstanceOf(TextValue::class, $entity->uuid);
        $this->assertNotEquals($oldValue, $entity->getUUID());
        $this->assertEquals($newValue, $entity->getUUID());
    }

    public function test_can_mutate_user_gender(): void
    {
        // arrange
        $oldValue = 'male';
        $newValue = 'female';

        // act
        $entity = new UserEntity([
            'uuid' => '12345-xxxx-a1a1a1-qef0912',
            'gender' => $oldValue,
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
        $entity->setGender($newValue);

        // assert
        $this->assertInstanceOf(TextValue::class, $entity->gender);
        $this->assertNotEquals($oldValue, $entity->getGender());
        $this->assertEquals($newValue, $entity->getGender());
    }

    public function test_can_mutate_user_name(): void
    {
        // arrange
        $oldValue = [
            'title' => 'mr',
            'first' => 'john',
            'last' => 'doe'
        ];
        $newValue = [
            'title' => 'mr',
            'first' => 'doe',
            'last' => 'john'
        ];

        // act
        $entity = new UserEntity([
            'uuid' => '12345-xxxx-a1a1a1-qef0912',
            'gender' => 'male',
            'name' => $oldValue,
            'dob' => [
                'date' => '2021-12-31T17:57:54.969Z',
                'age' => 30
            ],
        ]);
        $entity->setName($newValue);

        // assert
        $this->assertInstanceOf(FullNameValue::class, $entity->name);
        $this->assertNotEquals($oldValue, $entity->getName());
        $this->assertEquals($newValue, $entity->getName());
    }

    public function test_can_mutate_user_dob(): void
    {
        // arrange
        $oldValue = [
            'date' => '2021-12-31T17:57:54.969Z',
            'age' => 30
        ];
        $newValue = [
            'date' => '2021-12-31T17:57:54.969Z',
            'age' => 25
        ];

        // act
        $entity = new UserEntity([
            'uuid' => '12345-xxxx-a1a1a1-qef0912',
            'gender' => 'male',
            'name' => [
                'title' => 'mr',
                'first' => 'john',
                'last' => 'doe'
            ],
            'dob' => $oldValue,
        ]);
        $entity->setDOB($newValue);

        // assert
        $this->assertInstanceOf(DateOfBirthValue::class, $entity->dob);
        $this->assertNotEquals($oldValue, $entity->getDOB());
        $this->assertEquals($newValue, $entity->getDOB());
    }

    public function test_can_transform_location_entity_as_array(): void
    {
        // arrange
        $attributes = [
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
        ];

        // act
        $entity = new UserEntity($attributes);

        // assert
        $this->assertEquals($attributes, $entity->toArray());
    }
}
