<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\CarBrand
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $image_name
 * @property int|null $is_popular
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VehicleModel[] $carModels
 * @property-read int|null $car_models_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Offer[] $offers
 * @property-read int|null $offers_count
 * @method static \Illuminate\Database\Eloquent\Builder|CarBrand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarBrand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarBrand query()
 * @method static \Illuminate\Database\Eloquent\Builder|CarBrand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarBrand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarBrand whereImageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarBrand whereIsPopular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarBrand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarBrand whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarBrand extends Model
{
    use HasFactory;

    protected $table = 'car_brands';
    protected $hidden = ['created_at', 'updated_at'];


    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function carModels(): HasMany
    {
        return $this->hasMany(VehicleModel::class, 'car_brands_id');
    }
}
