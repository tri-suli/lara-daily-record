<?php

declare(strict_types=1);

namespace app\ValueObjects;

abstract class ValueObject
{
    /**
     * Represents the object value.
     *
     * @param mixed $value
     */
    protected mixed $value;

    /**
     * Magic method that gets called when an inaccessible property is accessed.
     *
     * @param string $name The name of the property being accessed.
     * @return mixed|null The value of the property if it exists, otherwise null.
     */
    public function __get(string $name): mixed
    {
        if ($name === 'value') {
            return $this->value;
        }

        return null;
    }

    /**
     * Magic method to set a property value.
     *
     * @param string $name The name of the property to set.
     * @param mixed $value The value to set the property to.
     */
    public function __set(string $name, mixed $value): void
    {
        // Prevent immutability
    }

    /**
     * Check if the value of the current object is equal to the value of another object.
     *
     * @param self $object The object to compare with.
     * @return bool True if the values are equal, false otherwise.
     */
    public function equals(self $object): bool
    {
        return $this->value === $object->value;
    }

    /**
     * Determine if the given object is not equal to the current object.
     *
     * @param self $object The object to compare against.
     * @return bool True if the given object is not equal to the current object, false otherwise.
     */
    public function notEquals(self $object): bool
    {
        return ! $this->equals($object);
    }
}
