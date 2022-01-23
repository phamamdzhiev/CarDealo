<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\OfferExtras
 *
 * @property int $id
 * @property int $vehicle_offer_id
 * @property int $extra_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras query()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras whereExtraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferExtras whereVehicleOfferId($value)
 * @mixin \Eloquent
 */
class OfferExtras extends Pivot
{
    use HasFactory;
    protected $table = 'offers_car_extras';

}
