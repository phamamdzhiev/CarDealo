<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VehicleType
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleType query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleType whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleType whereName($value)
 * @mixin \Eloquent
 */
class VehicleType extends Model
{
    use HasFactory;

    protected $table = 'vehicles_types';
    public $timestamps = false;
}
