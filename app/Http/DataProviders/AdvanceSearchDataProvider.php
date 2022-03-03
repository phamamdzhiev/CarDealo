<?php

namespace App\Http\DataProviders;

use App\Models\Filters\BudgetFilter;
use App\Models\Filters\ColorFilter;
use App\Models\Filters\FuelFilter;
use App\Models\Filters\KmFilter;
use App\Models\Filters\TransmissionFilter;
use App\Models\Filters\YearFilter;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AdvanceSearchDataProvider
{
    /**
     * @var Builder
     */
    private Builder $offer;

    /**
     * @param BudgetFilter $budgetFilter
     * @param FuelFilter $fuelFilter
     * @param YearFilter $yearFilter
     * @param KmFilter $kmFilter
     * @param ColorFilter $colorFilter
     * @param TransmissionFilter $transmissionFilter
     */
    public function __construct(
        BudgetFilter $budgetFilter,
        FuelFilter $fuelFilter,
        YearFilter $yearFilter,
        KmFilter $kmFilter,
        ColorFilter $colorFilter,
        TransmissionFilter $transmissionFilter
    )
    {
        $this->offer =  Offer::join('vehicles', 'vehicles.offer_id', '=', 'offers.id');
        $this->offer->join('images', 'images.offer_id', '=', 'offers.id');

        $budgetFilter
            ->applyTo($this->offer);
        $fuelFilter
            ->applyTo($this->offer);
        $yearFilter
            ->applyTo($this->offer);
        $kmFilter
            ->applyTo($this->offer);
        $colorFilter
            ->applyTo($this->offer);
        $transmissionFilter
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
