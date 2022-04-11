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
use App\Models\Filters\VehicleTypePopular;
use App\Models\Filters\YearFilter;
use App\Models\Modifiers\LimitOffers;
use App\Models\Modifiers\MostViewers;
use App\Models\Repository\OfferRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Collection;
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
     * @param VehicleCategoryFilter $vehicleCategoryFilter
     * @param VehicleTypeFilter $vehicleTypeFilter
     * @param BrandFilter $brandFilter
     * @param RegionFilter $regionFilter
     * @param MostViewers $mostViewers
     * @param LimitOffers $limitOffers
     * @param VehicleTypePopular $vehicleTypePopular
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
        RegionFilter $regionFilter,
        MostViewers $mostViewers,
        LimitOffers $limitOffers,
        VehicleTypePopular $vehicleTypePopular
    )
    {
        $offerRepository = new OfferRepository();
        $this->offer = $offerRepository->getSingleOfferQuery();

        $budgetFilter->applyTo($this->offer);
        $fuelFilter->applyTo($this->offer);
        $yearFilter->applyTo($this->offer);
        $kmFilter->applyTo($this->offer);
        $colorFilter->applyTo($this->offer);
        $transmissionFilter->applyTo($this->offer);
        $vehicleCategoryFilter->applyTo($this->offer);
        $vehicleTypeFilter->applyTo($this->offer);
        $brandFilter->applyTo($this->offer);
        $regionFilter->applyTo($this->offer);
        $mostViewers->applyTo($this->offer);
        $limitOffers->applyTo($this->offer);
        $vehicleTypePopular->applyTo($this->offer);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getOffers(): LengthAwarePaginator
    {
        return $this->offer->paginate(20);
    }
}
