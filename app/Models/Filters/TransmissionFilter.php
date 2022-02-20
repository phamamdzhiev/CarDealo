<?php
namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

class TransmissionFilter extends AbstractBaseFilter
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when(is_array($this->request->input('transmission')), function ($offer) {
            $offer->whereIn('transmission', $this->request->input('transmission'));
        });
    }
}
