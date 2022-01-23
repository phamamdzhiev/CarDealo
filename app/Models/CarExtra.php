<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CarExtra
 *
 * @property int $id
 * @property string $extra
 * @property int $extra_category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Offer[] $extras
 * @property-read int|null $extras_count
 * @method static \Illuminate\Database\Eloquent\Builder|CarExtra newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarExtra newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarExtra query()
 * @method static \Illuminate\Database\Eloquent\Builder|CarExtra whereExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarExtra whereExtraCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarExtra whereId($value)
 * @mixin \Eloquent
 */
class CarExtra extends Model
{
    use HasFactory;
    protected $table = 'car_extras';

    public function extras(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Offer::class)->using(OfferExtras::class);
    }
}
