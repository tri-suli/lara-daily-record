<?php

declare(strict_types=1);

namespace App\ValueObjects\Attributes;

use App\ValueObjects\AssocValue;

class DateOfBirthValue extends AssocValue
{
    /**
     * Create a new date of birth value object instance
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        parent::__construct($attributes, ['date', 'age']);
    }

    /**
     * Get dob date
     *
     * @return string
     */
    public function date(): string
    {
        return $this->value['date'];
    }

    /**
     * Get the age value from the value.
     *
     * @return int
     */
    public function age(): int
    {
        return $this->value['age'];
    }
}
