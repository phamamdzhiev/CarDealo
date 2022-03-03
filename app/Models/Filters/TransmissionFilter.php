<?php
namespace App\Models\Filters;

use Illuminate\Database\Query\Builder;

class TransmissionFilter extends AbstractBaseFilter
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when(is_array($this->request->input('transmission')), function ($offer) {
            $offer->whereIn('vehicles.transmission_id', $this->request->input('transmission'));
        });
    }
}
