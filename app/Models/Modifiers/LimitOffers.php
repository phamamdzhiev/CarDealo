<?php
namespace App\Models\Modifiers;

use Illuminate\Database\Query\Builder;

class LimitOffers extends AbstractBaseModifier
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when($this->request->input('limit'), function (Builder $offer) {
            $offer->limit($this->request->input('limit'));
        });
    }
}
