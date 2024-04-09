<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyRecord extends Model
{
    use HasFactory;

    /**
     * Indicates that this model doesn't have timestamp columns
     *
     * @var null
     */
    public $timestamps = false;

    /**
     * Indicates that this model doesn't have primary key column
     *
     * @var null
     */
    protected $primaryKey = null;

    /**
     * Indicates that this model doesn't implement auto increment value
     * for primary column
     *
     * @var null
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'male_count',
        'male_avg_age',
        'female_count',
        'female_avg_age'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'male_avg_age' => 'integer',
            'female_avg_age' => 'integer',
        ];
    }
}
