<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Merchant
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $address
 * @property string $eik
 * @property string|null $domain
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereEik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Merchant whereUserId($value)
 * @mixin \Eloquent
 */
class Merchant extends Model
{
    use HasFactory;

    protected $table = 'merchants';
    protected $guarded = [];
}
