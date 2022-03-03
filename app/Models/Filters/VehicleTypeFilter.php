<?php
namespace App\Models\Filters;

use Illuminate\Database\Query\Builder;

class VehicleTypeFilter extends AbstractBaseFilter
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when($this->request->input('type'), function ($offer) {
            $offer->where('vehicles_types.id', $this->request->input('type'));
        });
    }
}
