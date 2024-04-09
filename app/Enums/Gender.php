<?php

declare(strict_types=1);

namespace App\Enums;

enum Gender: string
{
    case MALE = 'male';

    case FEMALE = 'female';

    /**
     * Get the values of the enum.
     *
     * @return array
     */
    public static function values(): array
    {
        return [
            self::MALE,
            self::FEMALE
        ];
    }

    /**
     * Get the label for the enum value.
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::MALE => 'Male',
            self::FEMALE => 'Female',
        };
    }
}
