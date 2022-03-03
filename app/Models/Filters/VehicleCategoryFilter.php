<?php
namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

class VehicleCategoryFilter extends AbstractBaseFilter
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when($this->request->input('category'), function ($offer) {
            $offer->whereIn('vehicles_types.category_id', $this->request->input('category'));
        });
    }
}
