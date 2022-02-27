<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VehicleCategory
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleCategory whereName($value)
 * @mixin \Eloquent
 */
class VehicleCategory extends Model
{
    use HasFactory;
    protected $table = 'vehicles_category';
    public $timestamps = false;
}
