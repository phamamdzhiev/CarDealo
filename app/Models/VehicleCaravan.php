<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCaravan extends Model
{
    use HasFactory;

    protected $table = 'vehicles_caravan';
    public $timestamps = false;
    protected $guarded = [];
}
