<?php
namespace App\Models\Filters;

use Illuminate\Database\Query\Builder;

class BrandFilter extends AbstractBaseFilter
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when($this->request->input('brand'), function ($offer) {
            $offer->where('vehicles.brand_id', $this->request->input('brand'));
        });
    }
}
