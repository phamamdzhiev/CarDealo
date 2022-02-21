<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\TopOffer
 *
 * @property int $id
 * @property int $offer_id
 * @property string $date_start
 * @property string $date_end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Offer[] $offer
 * @property-read int|null $offer_count
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TopOffer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TopOffer extends Model
{
    use HasFactory;

    protected $fillable = ['offer_id', 'date_start', 'date_end'];

    /**
     * @return HasMany
     */
    public function offer(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
}
