<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VehicleBoat
 *
 * @property int $id
 * @property int|null $vehicle_id
 * @property int|null $working_hours
 * @property string|null $model
 * @property int|null $engine_number
 * @property int|null $width
 * @property int|null $height
 * @property int|null $wade
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleBoat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleBoat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleBoat query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleBoat whereEngineNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleBoat whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleBoat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleBoat whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleBoat whereVehicleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleBoat whereWade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleBoat whereWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleBoat whereWorkingHours($value)
 * @mixin \Eloquent
 */
class VehicleBoat extends Model
{
    use HasFactory;

    protected $table = 'vehicles_boats';
    public $timestamps = false;
    protected $guarded = [];
}
