<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Floor
 *
 * @package App
 * @property int $id
 * @property int $number
 * @property string $description
 * @property int $desks
 * @property int $location_id
 */
class Floor extends Model
{
    /**
     * @var string
     */
    protected $table = "floors";

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
        'number',
        'description',
        'desks',
        'location_id',
    ];
}