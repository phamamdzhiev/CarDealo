<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Fraud
 *
 * @property int $id
 * @property string $email
 * @property string $message
 * @property int $offer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Fraud newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fraud newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fraud query()
 * @method static \Illuminate\Database\Eloquent\Builder|Fraud whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fraud whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fraud whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fraud whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fraud whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fraud whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Fraud extends Model
{
    use HasFactory;

    protected $guarded = [];
}
