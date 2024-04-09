<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Aggregates\UserWithLocation;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, HasUuids, Notifiable, SoftDeletes;

    /**
     * {@inheritdoc}
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'gender',
        'age',
        'location'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name' => 'array',
            'location' => 'array',
        ];
    }

    public static function createUser(UserWithLocation $user): User
    {
        /** @var User */
        return static::query()->updateOrCreate(
            ['uuid' => $user->getUser()->getUUID()],
            $user->toArray()
        );
    }

    public static function countByGender(string $gender): int
    {
        return static::query()->where('gender', $gender)->count('gender');
    }

    public static function countMale(): int
    {
        return self::countByGender('male');
    }

    public static function countFemale(): int
    {
        return self::countByGender('female');
    }
}
