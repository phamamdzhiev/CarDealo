<?php
namespace App\Models\Filters;

use Illuminate\Database\Query\Builder;

class BudgetFilter extends AbstractBaseFilter
{
    /**
     * @param Builder $offer
     * @return void
     */
    public function applyTo(Builder $offer): void
    {
        $offer->when($this->request->input('budgetMin'), function ($offer) {
            $offer->where('offers.price', '>=', $this->request->input('budgetMin'));
        });

        $offer->when(
            ($this->request->input('budgetMax') && $this->request->input('budgetMax') < 20000),
            function ($offer) {
                $offer->where('offers.price', '<=', $this->request->input('budgetMax'));
            }
        );
    }
}
