<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Transmission
 *
 * @property int $id
 * @property string|null $name
 * @method static \Illuminate\Database\Eloquent\Builder|Transmission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transmission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transmission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transmission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transmission whereName($value)
 * @mixin \Eloquent
 */
class Transmission extends Model
{
    use HasFactory;

    protected $table = 'transmissions';
    public $timestamps = false;
    protected $guarded = [];
}
