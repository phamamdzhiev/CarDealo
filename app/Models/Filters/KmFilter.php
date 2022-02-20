<?php
namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

class KmFilter extends AbstractBaseFilter
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when($this->request->input('kmMin'), function ($offer) {
            $offer->where('km', '>=', $this->request->input('kmMin'));
        });

        $offer->when($this->request->input('kmMax'), function ($offer) {
            $offer->where('km', '<=', $this->request->input('kmMax'));
        });
    }
}
