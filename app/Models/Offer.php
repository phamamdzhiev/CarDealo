<?php

namespace App\Models;

use App\Models\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 * @property int $user_id
 * @property int $is_approved
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Offer approved()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer notApproved()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUserId($value)
 * @property-read \App\Models\TopOffer|null $topOffers
 * @property-read \App\Models\VipOffer|null $vipOffers
 */
class Offer  extends Model
{
    use HasFactory;
    protected $table = 'offers';

    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function getCarBrands(): BelongsTo
    {
        return $this->belongsTo(VehicleModel::class, 'car_brands_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeApproved($query): mixed
    {
        return $query->where('is_approved', '=', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNotApproved($query): mixed
    {
        return $query->where('is_approved', '=', 0);
    }

    //Paid Offers

    /**
     * @return BelongsTo
     */
    public function vipOffers(): BelongsTo
    {
        return $this->belongsTo(VipOffer::class);
    }

    /**
     * @return BelongsTo
     */
    public function topOffers(): BelongsTo
    {
        return $this->belongsTo(TopOffer::class);
    }
}
