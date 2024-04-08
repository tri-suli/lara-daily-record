<?php

namespace Tests\Unit\ValueObjects;

use App\ValueObjects\TextValue;
use PHPUnit\Framework\TestCase;

class TextValueTest extends TestCase
{
    public function test_value_object_text_can_be_converted_as_string(): void
    {
        // arrange
        $value = 'random text';

        // act
        $object = new TextValue($value);

        // assert
        $this->assertEquals($value, $object->value);
        $this->assertEquals($value, $object);
    }

    public function test_should_return_true_when_text_objects_are_equals(): void
    {
        // arrange
        $object1 = new TextValue('hello');
        $object2 = new TextValue('hello');

        // act
        $isEqual = $object1->equals($object2);

        // assert
        $this->assertTrue($isEqual);
    }

    public function test_should_return_true_when_text_objects_are_not_equals(): void
    {
        // arrange
        $object1 = new TextValue('hello');
        $object2 = new TextValue('world');

        // act
        $isNotEquals = $object1->notEquals($object2);

        // assert
        $this->assertTrue($isNotEquals);
    }
}
