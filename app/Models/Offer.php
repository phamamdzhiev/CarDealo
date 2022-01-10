<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer  extends Model
{
    use HasFactory;
    protected $table = 'offers';

    public function getCarBrands(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'car_brands_id', 'id');
    }

    public function asd()
    {
        return $this->belongsToMany(CarExtra::class)->using(OfferExtras::class);
    }
}
