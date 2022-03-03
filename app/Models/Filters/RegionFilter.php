<?php
namespace App\Models\Filters;

use Illuminate\Database\Query\Builder;

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
                ->where('cities.region_id', $this->request->input('brand'));
        });
    }
}
