<?php
namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

class BudgetFilter extends AbstractBaseFilter
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when($this->request->input('budgetMin'), function ($offer) {
            $offer->where('price', '>=', $this->request->input('budgetMin'));
        });

        $offer->when($this->request->input('budgetMax'), function ($offer) {
            $offer->where('price', '<=', $this->request->input('budgetMax'));
        });
    }
}
