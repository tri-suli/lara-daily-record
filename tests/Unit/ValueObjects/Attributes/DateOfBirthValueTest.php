<?php

namespace Tests\Unit\ValueObjects\Attributes;

use App\ValueObjects\Attributes\DateOfBirthValue;
use PHPUnit\Framework\TestCase;

class DateOfBirthValueTest extends TestCase
{
    public function test_can_create_an_assoc_array_object(): void
    {
        // arrange
        $attributes = [
            'age' => 30,
            'date' => '2021-12-31T17:57:54.969Z',
        ];

        // act
        $object = new DateOfBirthValue($attributes);

        // assert
        $this->assertEquals($attributes['date'], $object->date());
        $this->assertEquals($attributes['age'], $object->age());
        $this->assertEquals($attributes, $object->toArray());
    }
}
