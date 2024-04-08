<?php

namespace Tests\Unit\ValueObjects;

use App\ValueObjects\AssocValue;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AssocValueTest extends TestCase
{
    public function test_should_throw_an_error_when_the_attributes_not_assoc_array(): void
    {
        // assert
        $this->expectException(InvalidArgumentException::class);

        // act
        $attributes = ['value1', 'value2'];
        new AssocValue($attributes, ['key1' => 'value1']);
    }

    public function test_should_throw_an_error_when_the_keys_not_assoc_array(): void
    {
        // assert
        $this->expectException(InvalidArgumentException::class);

        // act
        $attributes = ['key1' => 'value1', 'key2' => 'value2'];
        $keys = $attributes;
        new AssocValue($attributes, $keys);
    }

    public function test_can_create_an_assoc_array_object(): void
    {
        // arrange
        $attributes = [
            'gender' => 'male',
            'postcode' => 12345,
            'street' => [
                'number' => 100,
                'name' => 'street name'
            ],
            'indexed' => [
                'test',
                1234
            ]
        ];
        $keys = ['gender', 'postcode', 'street', 'indexed'];

        // act
        $object = new AssocValue($attributes, $keys);

        // assert
        $this->assertEquals($attributes, $object->toArray());
    }

    public function test_should_return_true_when_the_object_values_are_equals(): void
    {
        // arrange
        $object1 = new AssocValue(['a' => 1, 'b' => 2, 'c' => 3], ['a', 'b', 'c']);
        $object2 = new AssocValue(['a' => 1, 'b' => 2, 'c' => 3], ['a', 'b', 'c']);

        // act
        $isEqual = $object1->equals($object2);

        // assert
        $this->assertTrue($isEqual);
    }

    public function test_should_return_true_when_the_object_values_are_not_equals(): void
    {
        // arrange
        $object1 = new AssocValue(['a' => 1, 'b' => 2, 'c' => '3'], ['a', 'b', 'c']);
        $object2 = new AssocValue(['a' => '1', 'b' => 2, 'c' => 3], ['a', 'b', 'c']);

        // act
        $isEqual = $object1->notEquals($object2);

        // assert
        $this->assertTrue($isEqual);
    }
}
