<?php
namespace App\Models\Modifiers;

use Illuminate\Database\Query\Builder;

class MostViewers extends AbstractBaseModifier
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when($this->request->input('mostViewers'), function (Builder $offer) {
            $offer->orderByDesc('offers.visits');
        });
    }
}
