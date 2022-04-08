<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\CategoryExtra
 *
 * @property int $id
 * @property int $category_id
 * @property int $extra_id
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryExtra newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryExtra newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryExtra query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryExtra whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryExtra whereExtraId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryExtra whereId($value)
 * @mixin \Eloquent
 */
class CategoryExtra extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'category_extras';

    /**
     * @var bool
     */
    public $timestamps = false;

}
