<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\VehicleExtra
 *
 * @property int $id
 * @property int $vehicle_id
 * @property int $extra_id
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleExtra newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleExtra newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleExtra query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleExtra whereExtraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleExtra whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleExtra whereVehicleId($value)
 * @mixin \Eloquent
 */
class VehicleExtra extends Pivot
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'vehicles_extra';

    /**
     * @var bool
     */
    public $timestamps = false;

}
