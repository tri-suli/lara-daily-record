<?php

declare(strict_types=1);

namespace App\Entities;

use App\ValueObjects\AssocValue;
use App\ValueObjects\NumericValue;
use App\ValueObjects\TextValue;

class LocationEntity extends Entity
{
    /**
     * Represents a value object instance that store the location city value
     *
     * @var TextValue
     */
    protected TextValue $city;

    /**
     * Represents a value object instance that store the location state value
     *
     * @var TextValue
     */
    protected TextValue $state;

    /**
     * Represents a value object instance that store the location country value
     *
     * @var TextValue
     */
    protected TextValue $country;

    /**
     * Represents a value object instance that store the location postcode value
     *
     * @var NumericValue
     */
    protected NumericValue $postcode;

    /**
     * Represents a value object instance that stores the street address value.
     *
     * @var AssocValue
     */
    protected AssocValue $street;

    /**
     * Represents a value object instance that stores the geographical coordinates of a location.
     *
     * @var AssocValue
     */
    protected AssocValue $coordinates;

    /**
     * Represents a value object instance that stores the location timezone value.
     *
     * @var AssocValue
     */
    protected AssocValue $timezone;

    /**
     * Create a new location entity instance
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->setCity($attributes['city']);
        $this->setState($attributes['state']);
        $this->setCountry($attributes['country']);
        $this->setPostcode($attributes['postcode']);
        $this->setStreet($attributes['street']);
        $this->setCoordinates($attributes['coordinates']);
        $this->setTimezone($attributes['timezone']);
    }

    /**
     * Retrieves city attributes as string
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->city->value;
    }

    /**
     * Set the city attributes as value object.
     *
     * @param string|TextValue $value
     * @return void
     */
    public function setCity(string|TextValue $value): void
    {
        $this->setTextValue('city', $value);
    }

    /**
     * Retrieves country attributes as string
     *
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country->value;
    }

    /**
     * Set the country attributes as value object.
     *
     * @param string|TextValue $value
     * @return void
     */
    public function setCountry(string|TextValue $value): void
    {
        $this->setTextValue('country', $value);
    }

    /**
     * Retrieves state attributes as string
     *
     * @return string
     */
    public function getState(): string
    {
        return $this->state->value;
    }

    /**
     * Set the state attributes as value object.
     *
     * @param string|TextValue $value
     * @return void
     */
    public function setState(string|TextValue $value): void
    {
        $this->setTextValue('state', $value);
    }

    /**
     * Retrieves postcode attributes as number
     *
     * @return int
     */
    public function getPostcode(): int
    {
        return intval($this->postcode->value);
    }

    /**
     * Set the postcode attributes as value object.
     *
     * @param int|string|NumericValue $value
     * @return void
     */
    public function setPostcode(int|string|NumericValue $value): void
    {
        $this->setNumericValue('postcode', intval($value));
    }

    /**
     * Get the street details.
     *
     * @return array The street information as an array.
     */
    public function getStreet(): array
    {
        return $this->street->toArray();
    }

    /**
     * Set the street value.
     *
     * @param array|AssocValue $value The value to set.
     * @return void
     */
    public function setStreet(array|AssocValue $value): void
    {
        $this->setAssocValue('street', $value, ['number', 'name']);
    }

    /**
     * Get the coordinates of the application.
     *
     * @return array The array of coordinates.
     */
    public function getCoordinates(): array
    {
        return $this->coordinates->toArray();
    }

    /**
     * Set the coordinates of the object.
     *
     * @param array|AssocValue $value The coordinates value. Either an array or an instance of AssocValue
     * @return void
     */
    public function setCoordinates(array|AssocValue $value): void
    {
        $this->setAssocValue('coordinates', $value, ['latitude', 'longitude']);
    }

    /**
     * Get the timezone details in array format.
     *
     * @return array The timezone details in array format.
     */
    public function getTimezone(): array
    {
        return $this->timezone->toArray();
    }

    /**
     * Set the timezone value.
     *
     * @param array|AssocValue $value The value to set for timezone.
     *
     * @return void
     */
    public function setTimezone(array|AssocValue $value): void
    {
        $this->setAssocValue('timezone', $value, ['offset', 'description']);
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'street' => $this->getStreet(),
            'city' => $this->getCity(),
            'state' => $this->getState(),
            'country' => $this->getCountry(),
            'postcode' => $this->getPostcode(),
            'coordinates' => $this->getCoordinates(),
            'timezone' => $this->getTimezone(),
        ];
    }
}
