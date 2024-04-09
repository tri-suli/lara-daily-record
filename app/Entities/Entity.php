<?php

namespace App\Entities;

use App\ValueObjects\AssocValue;
use App\ValueObjects\NumericValue;
use App\ValueObjects\TextValue;
use Illuminate\Contracts\Support\Arrayable;

abstract class Entity implements Arrayable
{
    /**
     * @inheritDoc
     */
    public abstract function toArray(): array;

    /**
     * Magic method that is called when accessing inaccessible properties.
     *
     * @param string $name The name of the property being accessed.
     * @return mixed|null The value of the property if it exists, null otherwise.
     */
    public function __get(string $name)
    {
        if ($this->hasAttribute($name)) {
            return $this->$name;
        }

        return null;
    }

    /**
     * Magic method to set the value of an attribute.
     *
     * @param string $name The name of the attribute to set.
     * @param mixed $value The value to assign to the attribute.
     * @return void
     */
    public function __set(string $name, mixed $value)
    {
        if ($this->hasAttribute($name)) {
            $this->{$name} = $value;
        }
    }

    /**
     * Checks if the given attribute exists in the current class.
     *
     * @param string $attribute The attribute name to check.
     * @return bool  True if the attribute exists, false otherwise.
     */
    public function hasAttribute(string $attribute): bool
    {
        return property_exists($this, $attribute);
    }

    /**
     * Set the value of an associative attribute.
     *
     * If the value is an instance of AssocValue, set the attribute directly.
     * Otherwise, create a new instance of AssocValue and assign it to the attribute.
     *
     * @param string $attribute The name of the attribute to set the value for.
     * @param array|AssocValue $value The value to set for the attribute.
     * @param array $keys The keys to use if creating a new AssocValue instance.
     * @return void
     */
    protected function setAssocValue(string $attribute, array|AssocValue $value, array $keys): void
    {
        if ($value instanceof AssocValue) {
            $this->{$attribute} = $value;
        } else {
            $this->{$attribute} = new AssocValue($value, $keys);
        }
    }

    /**
     * Sets a numeric value to the specified attribute.
     *
     * @param string $attribute The attribute to set the value to.
     * @param int|float|string|NumericValue $value The numeric value to set.
     * @return void
     */
    protected function setNumericValue(string $attribute, int|float|string|NumericValue $value): void
    {
        if ($value instanceof NumericValue) {
            $this->{$attribute} = $value;
        } else {
            $this->{$attribute} = new NumericValue($value);
        }
    }

    /**
     * Sets the value of a text attribute.
     *
     * @param string $attribute The name of the attribute to set.
     * @param string|TextValue $value The value to be set.
     *                               If it's an instance of TextValue, it will be assigned directly to the attribute.
     *                               If it's a string, it will be wrapped in a new TextValue instance and assigned to the attribute.
     * @return void
     */
    protected function setTextValue(string $attribute, string|TextValue $value): void
    {
        if ($value instanceof TextValue) {
            $this->{$attribute} = $value;
        } else {
            $this->{$attribute} = new TextValue($value);
        }
    }
}
