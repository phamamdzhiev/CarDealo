<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarExtra extends Model
{
    use HasFactory;
    protected $table = 'car_extras';

    public function extras(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Offer::class)->using(OfferExtras::class);
    }
}
