<?php
namespace App\Models\Filters;

use Illuminate\Database\Query\Builder;

class KmFilter extends AbstractBaseFilter
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when($this->request->input('kmMin'), function ($offer) {
            $offer->where('vehicles.km', '>=', $this->request->input('kmMin'));
        });

        $offer->when($this->request->input('kmMax'), function ($offer) {
            $offer->where('vehicles.km', '<=', $this->request->input('kmMax'));
        });
    }
}
