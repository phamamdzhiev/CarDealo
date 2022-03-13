<?php
namespace App\Models\Filters;

use Illuminate\Database\Query\Builder;

class VehicleTypePopular extends AbstractBaseFilter
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when($this->request->input('type'), function ($offer) {
            $offer->where('vehicles_types.is_popular', true);
        });
    }
}
