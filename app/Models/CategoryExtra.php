<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
