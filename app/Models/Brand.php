<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Brand
 *
 * @property int $id
 * @property string $name
 * @property string|null $image_name
 * @property int|null $is_popular
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereImageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereIsPopular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereName($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VehicleCategory[] $category
 * @property-read int|null $category_count
 */
class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $guarded = [];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsToMany(
            VehicleCategory::class, 'category_brand_model',
            'brand_id', 'category_id')
            ->using(CategoryBrandModel::class);
    }
}
