<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\VehicleModel
 *
 * @property-read \App\Models\Brand|null $brands
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleModel query()
 * @mixin \Eloquent
 */
class VehicleModel extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function brands(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
