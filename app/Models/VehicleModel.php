<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Krlove\EloquentModelGenerator\Model\BelongsToMany;

/**
 * App\Models\VehicleModel
 *
 * @property-read \App\Models\Brand|null $brands
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property int $brand_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VehicleCategory[] $category
 * @property-read int|null $category_count
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel whereName($value)
 */
class VehicleModel extends Model
{
    protected $table = 'models';
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function category()
    {
        return $this->belongsToMany(
            VehicleCategory::class, 'category_brand_model',
            'model_id', 'category_id')
            ->using(CategoryBrandModel::class);
    }
}
