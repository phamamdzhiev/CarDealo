<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleBoat extends Model
{
    use HasFactory;

    protected $table = 'vehicles_boats';
    public $timestamps = false;
    protected $guarded = [];
}
