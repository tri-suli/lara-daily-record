<?php

namespace Tests\Unit\ValueObjects\Attributes;

use App\ValueObjects\Attributes\FullNameValue;
use PHPUnit\Framework\TestCase;

class FullNameValueTest extends TestCase
{
    public function test_can_create_an_assoc_array_object(): void
    {
        // arrange
        $attributes = [
            'title' => 'Mr',
            'first' => 'First Name',
            'last' => 'Last Name',
        ];

        // act
        $object = new FullNameValue($attributes);

        // assert
        $this->assertEquals($attributes['title'], $object->title());
        $this->assertEquals($attributes['first'], $object->firstName());
        $this->assertEquals($attributes['last'], $object->lastName());
        $this->assertEquals('Mr. First Name Last Name', $object->fullName());
        $this->assertEquals($attributes, $object->toArray());
    }
}
