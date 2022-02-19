<?php

namespace App\Http\Controllers;


use App\Models\Filters\BudgetFilter;
use App\Models\Filters\FuelFilter;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdvancedSearch extends Controller
{
    /**
     * @param BudgetFilter $budgetFilter
     * @param FuelFilter $fuelFilter
     * @return JsonResponse
     */
    public function fetchOffers(
        BudgetFilter $budgetFilter,
        FuelFilter $fuelFilter
    ): JsonResponse
    {

        $offer =  Offer::with('images');
        $budgetFilter->applyTo($offer);
        $fuelFilter->applyTo($offer);

        return response()->json(
            $offer->get()
        );
    }
}
