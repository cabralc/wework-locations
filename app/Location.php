<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Location class
 *
 * @package App
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $opening_date
 * @property string $country
 * @property \Illuminate\Support\Collection $floor
 */
class Location extends Model
{
    /**
     * @var string
     */
    protected $table = "locations";

    /**
     * @var string
     */
    protected $primaryKey = "id";

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'opening_date',
        'country',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function floor(): HasMany
    {
        return $this->hasMany(Floor::class, 'location_id', 'id');
    }
}