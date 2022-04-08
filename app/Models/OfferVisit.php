<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OfferVisit
 *
 * @property int $id
 * @property int $offer_id
 * @property string $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVisit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVisit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVisit query()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVisit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVisit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVisit whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVisit whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferVisit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OfferVisit extends Model
{
    use HasFactory;
    protected $table = 'offer_visits';
}
