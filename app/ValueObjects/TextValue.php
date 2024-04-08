<?php

declare(strict_types=1);

namespace App\ValueObjects;

use Stringable;

class TextValue extends ValueObject implements Stringable
{
    /**
     * Create a new text value object instance
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return $this->value;
    }
}
