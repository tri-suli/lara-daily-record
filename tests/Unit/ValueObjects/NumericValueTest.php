<?php

namespace Tests\Unit\ValueObjects;

use App\ValueObjects\NumericValue;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class NumericValueTest extends TestCase
{
    public function test_should_throw_an_error_when_the_value_is_not_numeric(): void
    {
        // assert
        $this->expectException(InvalidArgumentException::class);

        // act
        $object = new NumericValue('0x539');
    }

    public function test_should_throw_an_error_when_the_value_is_not_a_number(): void
    {
        // assert
        $this->expectException(InvalidArgumentException::class);

        // act
        $object = new NumericValue('text');
    }

    public function test_can_create_a_number_value_object(): void
    {
        // act
        $float = new NumericValue(10.5);
        $int = new NumericValue(1);
        $numericString = new NumericValue('100');

        // assert
        $this->assertEquals(10.5, $float->value);
        $this->assertEquals(1, $int->value);
        $this->assertEquals(100, $numericString->value);
    }
}
