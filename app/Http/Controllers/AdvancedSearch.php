<?php

namespace App\Http\Controllers;


use App\Models\Offer;

class AdvancedSearch extends Controller
{
    public function fetchOffers(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Offer::with('images')->get());
    }
}
