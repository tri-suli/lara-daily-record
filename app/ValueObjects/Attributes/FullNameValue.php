<?php

declare(strict_types=1);

namespace App\ValueObjects\Attributes;

use App\ValueObjects\AssocValue;

class FullNameValue extends AssocValue
{
    /**
     * Create a new full name value object instance
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        parent::__construct($attributes, ['first', 'last', 'title']);
    }

    /**
     * Get the full name of the user.
     *
     * If the title is not set, return the first name and last name concatenated with a space.
     * Otherwise, return the title, first name, and last name with appropriate formatting.
     *
     * @return string The full name of the user.
     */
    public function fullName(): string
    {
        if (is_null($this->title())) {
            return sprintf('%s %s', $this->firstName(), $this->lastName());
        }

        return sprintf('%s. %s %s', $this->title(), $this->firstName(), $this->lastName());
    }

    /**
     * Get the first name of the user.
     *
     * Retrieve the first name from the value array and return it.
     *
     * @return string The first name of the user.
     */
    public function firstName(): string
    {
        return $this->value['first'];
    }

    /**
     * Get the last name of the user.
     *
     * Retrieve the last name value from the underlying data structure and return it.
     *
     * @return string The last name of the user.
     */
    public function lastName(): string
    {
        return $this->value['last'];
    }

    /**
     * Get the title of the user.
     *
     * This method retrieves the "title" value from the $value property of the class,
     * assuming it is an associative array. It then returns the value as a string.
     *
     * @return string The title of the user.
     */
    public function title(): string
    {
        return $this->value['title'];
    }
}
