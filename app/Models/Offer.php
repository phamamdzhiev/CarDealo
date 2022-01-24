<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Offer
 *
 * @property int $id
 * @property string $title
 * @property float $price
 * @property int $km
 * @property int $year
 * @property int $year_acquired
 * @property int $car_brands_id
 * @property int $car_models_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $description
 * @property int $is_new
 * @property int $fuel
 * @property int $cm3
 * @property int $hp
 * @property int $transmission
 * @property int $color
 * @property int $coupe_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CarExtra[] $asd
 * @property-read int|null $asd_count
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCarBrandsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCarModelsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCm3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCoupeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereFuel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereKm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereTransmission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereYearAcquired($value)
 * @mixin \Eloquent
 */
class Offer  extends Model
{
    use HasFactory;
    protected $table = 'offers';

    protected $guarded = [];
    public function getCarBrands(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'car_brands_id', 'id');
    }

    public function asd()
    {
        return $this->belongsToMany(CarExtra::class)->using(OfferExtras::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', '=', 1);
    }

    public function scopeNotApproved($query)
    {
        return $query->where('is_approved', '=', 0);
    }
}
