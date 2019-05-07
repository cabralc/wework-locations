<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

/**
 * Class Country
 *
 * @package App
 *
 * @property string $code
 * @property string $name
 * @property Collection $location
 *
 */
class Country extends Model
{
    /**
     * @var string
     */
    protected $table = "countries";

    /**
     * @var string
     */
    protected $primaryKey = "code";

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var boolean
     */
    public $incrementing = false;

    protected $fillable = [
        'code',
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function location(): HasMany
    {
        return $this->hasMany(Location::class, 'country', 'code');
    }
}