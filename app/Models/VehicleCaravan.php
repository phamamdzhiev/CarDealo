<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VehicleCaravan
 *
 * @property int $id
 * @property int $vehicle_id
 * @property int|null $wc
 * @property int|null $material_id
 * @property int|null $heating_id
 * @property string|null $model
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCaravan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCaravan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCaravan query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCaravan whereHeatingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCaravan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCaravan whereMaterialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCaravan whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCaravan whereVehicleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCaravan whereWc($value)
 * @mixin \Eloquent
 */
class VehicleCaravan extends Model
{
    use HasFactory;

    protected $table = 'vehicles_caravan';
    public $timestamps = false;
    protected $guarded = [];
}
