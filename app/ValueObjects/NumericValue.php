<?php

declare(strict_types=1);

namespace App\ValueObjects;

use InvalidArgumentException;

class NumericValue extends ValueObject
{
    /**
     * Create a new numeric value object instance
     *
     * @param float|string $value The value to be assigned to the object.
     *
     * @throws InvalidArgumentException If the provided value is not numeric.
     */
    public function __construct(float|string $value)
    {
        if (! is_numeric($value)) {
            throw new InvalidArgumentException('Numeric Object value must be a numeric value.');
        }

        $this->value = is_string($value) ? floatval($value) : $value;
    }
}
