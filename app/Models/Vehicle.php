<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Krlove\EloquentModelGenerator\Model\BelongsToMany;

/**
 * App\Models\Vehicle
 *
 * @property int $id
 * @property int|null $year
 * @property int|null $hp
 * @property int|null $km
 * @property int|null $cm3
 * @property int|null $fuel_id
 * @property int|null $transmission_id
 * @property int|null $color_id
 * @property int $brand_id
 * @property int|null $model_id
 * @property int $offer_id
 * @property int $type_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Extra[] $extras
 * @property-read int|null $extras_count
 * @property-read \App\Models\Fuel|null $fuel
 * @property-read \App\Models\Transmission|null $transmission
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCm3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFuelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereKm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereTransmissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereYear($value)
 * @mixin \Eloquent
 */
class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';
    public $timestamps = false;
    protected $guarded = [];

    /**
     * @return HasOne
     */
    public function transmission(): HasOne
    {
        return $this->hasOne(Transmission::class, 'id', 'transmission_id');
    }

    /**
     * @return HasOne
     */
    public function fuel(): HasOne
    {
        return $this->hasOne(Fuel::class, 'id', 'fuel_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function extras(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Extra::class, 'vehicles_extra',
            'vehicle_id', 'extra_id')
            ->using(VehicleExtra::class);
    }
}
