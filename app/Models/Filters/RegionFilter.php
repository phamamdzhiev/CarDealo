<?php
namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

class RegionFilter extends AbstractBaseFilter
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when($this->request->input('region'), function (Builder $offer) {
            $offer
                ->join('cities', 'cities.id', '=', 'offers.city_id')
                ->where('cities.region_id', $this->request->input('brand'));
        });
    }
}
