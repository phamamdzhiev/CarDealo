<?php
namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

class YearFilter extends AbstractBaseFilter
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when($this->request->input('yearMin'), function ($offer) {
            $offer->where('year', '>=', $this->request->input('yearMin'));
        });

        $offer->when($this->request->input('yearMax'), function ($offer) {
            $offer->where('year', '<=', $this->request->input('yearMax'));
        });
    }
}
