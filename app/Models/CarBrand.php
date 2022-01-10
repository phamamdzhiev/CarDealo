<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarBrand extends Model
{
    use HasFactory;

    protected $table = 'car_brands';
    protected $hidden = ['created_at', 'updated_at'];


    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function carModels(): HasMany
    {
        return $this->hasMany(CarModel::class, 'car_brands_id');
    }
}
