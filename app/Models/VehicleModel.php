<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CarModel
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $car_brands_id
 * @property-read \App\Models\CarBrand|null $carBrands
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel whereCarBrandsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class VehicleModel extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];

    public function carBrands(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarBrand::class);
    }
}
