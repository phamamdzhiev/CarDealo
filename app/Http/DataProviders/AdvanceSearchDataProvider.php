<?php

namespace App\Http\DataProviders;

use App\Models\Filters\BrandFilter;
use App\Models\Filters\BudgetFilter;
use App\Models\Filters\ColorFilter;
use App\Models\Filters\FuelFilter;
use App\Models\Filters\KmFilter;
use App\Models\Filters\RegionFilter;
use App\Models\Filters\TransmissionFilter;
use App\Models\Filters\VehicleCategoryFilter;
use App\Models\Filters\VehicleTypeFilter;
use App\Models\Filters\YearFilter;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;


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
     * @param VehicleCategoryFilter $vehicleCategoryFilter
     * @param VehicleTypeFilter $vehicleTypeFilter
     * @param BrandFilter $brandFilter
     * @param RegionFilter $regionFilter
     */
    public function __construct(
        BudgetFilter $budgetFilter,
        FuelFilter $fuelFilter,
        YearFilter $yearFilter,
        KmFilter $kmFilter,
        ColorFilter $colorFilter,
        TransmissionFilter $transmissionFilter,
        VehicleCategoryFilter $vehicleCategoryFilter,
        VehicleTypeFilter $vehicleTypeFilter,
        BrandFilter $brandFilter,
        RegionFilter $regionFilter
    )
    {
        $this->offer =  Offer::join('vehicles', 'vehicles.offer_id', '=', 'offers.id');
        $this->offer->join('images', 'images.offer_id', '=', 'offers.id');
        $this->offer->join('vehicles_types', 'vehicles.type_id', '=', 'vehicles_types.id');

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
        $vehicleCategoryFilter
            ->applyTo($this->offer);
        $vehicleTypeFilter
            ->applyTo($this->offer);
        $brandFilter
            ->applyTo($this->offer);
        $regionFilter
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
