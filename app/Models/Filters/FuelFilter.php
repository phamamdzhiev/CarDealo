<?php
namespace App\Models\Filters;

use Illuminate\Database\Query\Builder;

class FuelFilter extends AbstractBaseFilter
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when(is_array($this->request->input('fuel')), function ($offer) {
            $offer->whereIn('vehicles.fuel_id', $this->request->input('fuel'));
        });
    }
}
