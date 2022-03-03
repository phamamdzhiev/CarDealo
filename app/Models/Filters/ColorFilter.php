<?php
namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

class ColorFilter extends AbstractBaseFilter
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when(is_array($this->request->input('color')), function ($offer) {
            $offer->whereIn('vehicles.color_id', $this->request->input('color'));
        });
    }
}
