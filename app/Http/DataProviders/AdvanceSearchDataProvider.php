<?php

namespace App\Http\DataProviders;

use App\Models\Filters\BudgetFilter;
use App\Models\Filters\FuelFilter;
use App\Models\Filters\KmFilter;
use App\Models\Filters\YearFilter;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AdvanceSearchDataProvider
{
    /**
     * @var Builder
     */
    private Builder $offer;

    /**
     * @param BudgetFilter $budgetFilter
     * @param FuelFilter $fuelFilter
     */
    public function __construct(
        BudgetFilter $budgetFilter,
        FuelFilter $fuelFilter,
        YearFilter $yearFilter,
        KmFilter $kmFilter
    )
    {
        $this->offer =  Offer::with('images');

        $budgetFilter
            ->applyTo($this->offer);
        $fuelFilter
            ->applyTo($this->offer);
        $yearFilter
            ->applyTo($this->offer);
        $kmFilter
            ->applyTo($this->offer);
    }

    /**
     * @return Collection
     */
    public function getOffers(): Collection
    {
        return $this->offer->get();
    }
}
