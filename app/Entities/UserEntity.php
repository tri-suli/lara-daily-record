<?php

declare(strict_types=1);

namespace App\Entities;

use App\ValueObjects\Attributes\DateOfBirthValue;
use App\ValueObjects\Attributes\FullNameValue;
use App\ValueObjects\TextValue;

class UserEntity extends Entity
{
    /**
     * Represents a value object instance of user uuid
     *
     * @var TextValue
     */
    protected TextValue $uuid;

    /**
     * Represents a value object instance of user gender
     *
     * @var TextValue
     */
    protected TextValue $gender;

    /**
     * Represents a value object instance of user name
     *
     * @var FullNameValue
     */
    protected FullNameValue $name;

    /**
     * Represents a value object instance of user date of birth.
     *
     * @var DateOfBirthValue
     */
    protected DateOfBirthValue $dob;

    /**
     * Create a new user entity instance.
     *
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes)
    {
        $this->setUUID($attributes['uuid']);
        $this->setName($attributes['name']);
        $this->setGender($attributes['gender']);
        $this->setDOB($attributes['dob']);
    }

    /**
     * Get the UUID value.
     *
     * @return string The value of the UUID.
     */
    public function getUUID(): string
    {
        return $this->uuid->value;
    }

    /**
     * Set the UUID value.
     *
     * @param string|TextValue $value The value to set as the UUID.
     * @return void
     */
    public function setUUID(string|TextValue $value): void
    {
        $this->setTextValue('uuid', $value);
    }

    /**
     * Get the gender value.
     *
     * @return string The gender value.
     */
    public function getGender(): string
    {
        return $this->gender->value;
    }

    /**
     * Set the gender value.
     *
     * @param string|TextValue $value The gender value to set.
     * @return void
     */
    public function setGender(string|TextValue $value): void
    {
        $this->setTextValue('gender', $value);
    }

    /**
     * Get the name as an array.
     *
     * @return array
     */
    public function getName(): array
    {
        return $this->name->toArray();
    }

    /**
     * Sets the name value of the object.
     *
     * @param array|FullNameValue $value The new name value
     * @return void
     */
    public function setName(array|FullNameValue $value): void
    {
        if ($value instanceof FullNameValue) {
            $this->name = $value;
        } else {
            $this->name = new FullNameValue($value);
        }
    }

    /**
     * Retrieve the date of birth as an array.
     *
     * @return array The date of birth as an array, containing the 'day', 'month', and 'year' keys.
     */
    public function getDOB(): array
    {
        return $this->dob->toArray();
    }

    /**
     * Set the Date of Birth value for the user.
     *
     * @param array|DateOfBirthValue $value
     * @return void
     */
    public function setDOB(array|DateOfBirthValue $value): void
    {
        if ($value instanceof DateOfBirthValue) {
            $this->dob = $value;
        } else {
            $this->dob = new DateOfBirthValue($value);
        }
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'uuid' => $this->getUUID(),
            'name' => $this->getName(),
            'gender' => $this->getGender(),
            'dob' => $this->getDOB(),
        ];
    }
}
