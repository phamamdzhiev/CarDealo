<?php
namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void;
}
