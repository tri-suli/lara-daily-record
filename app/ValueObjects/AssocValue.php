<?php

declare(strict_types=1);

namespace App\ValueObjects;

use Illuminate\Support\Arr;
use InvalidArgumentException;
use Illuminate\Contracts\Support\Arrayable;

class AssocValue extends ValueObject implements Arrayable
{
    /**
     * Create a new associative array value object instance
     *
     * @param array<string, mixed> $attributes
     * @param array<int, string> $keys
     */
    public function __construct(array $attributes, array $keys)
    {
        if (! Arr::isAssoc($attributes)) {
            throw new InvalidArgumentException(
                'The attributes must be an associative array'
            );
        }

        if (Arr::isAssoc($keys)) {
            throw new InvalidArgumentException(
                'The keys must be an indexed array'
            );
        }

        $attributesKeys = array_keys($attributes);
        foreach ($attributesKeys as $key) {
            if (! in_array($key, $keys)) {
                throw new InvalidArgumentException(
                    sprintf('Cannot find attribute "%s" for keys "%s"', $key, implode(',', $keys))
                );
            }
        }

        $this->value = $attributes;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->value;
    }
}
