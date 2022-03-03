<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Krlove\EloquentModelGenerator\Model\BelongsToMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';
    public $timestamps = false;
    protected $guarded = [];

    /**
     * @return HasOne
     */
    public function transmission(): HasOne
    {
        return $this->hasOne(Transmission::class, 'id', 'transmission_id');
    }

    /**
     * @return HasOne
     */
    public function fuel(): HasOne
    {
        return $this->hasOne(Fuel::class, 'id', 'fuel_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function extras(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Extra::class, 'vehicles_extra',
            'vehicle_id', 'extra_id')
            ->using(VehicleExtra::class);
    }
}
