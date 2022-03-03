<?php

namespace App\Http\Controllers;

use App\Http\DataProviders\AdvanceSearchDataProvider;
use Illuminate\Http\JsonResponse;

class AdvancedSearch extends Controller
{
    /**
     * @param AdvanceSearchDataProvider $dataProvider
     * @return JsonResponse
     */
    public function fetchOffers(
        AdvanceSearchDataProvider $dataProvider
    ): JsonResponse
    {

        return response()->json(
            $dataProvider->getOffers()
        );
    }
}
