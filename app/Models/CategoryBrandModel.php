<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CategoryBrandModel
 *
 * @property int $id
 * @property int $category_id
 * @property int $brand_id
 * @property int|null $model_id
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryBrandModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryBrandModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryBrandModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryBrandModel whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryBrandModel whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryBrandModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryBrandModel whereModelId($value)
 * @mixin \Eloquent
 */
class CategoryBrandModel extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'category_brand_model';

    protected $guarded = [];

    public $timestamps = false;

}
