<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RegionController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        $regions = Cache::rememberForever('regions', function () {
            return Region::all()->toArray();
        });

        return response()->json($regions);
    }

    /**
     * @return JsonResponse
     */
    public function popular(): JsonResponse
    {
        $popularRegions = Cache::rememberForever('popular_regions', function () {
            return Region::whereIsPopular(1)->get()->toArray();
        });

        return response()->json([
            'success' => true,
            'data' => $popularRegions,
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getCitiesInRegion($id): JsonResponse
    {
        $cities = City::where('region_id', $id)
            ->orderBy('as_city', 'desc')
            ->orderBy('name')
            ->get();

        return response()->json($cities);
    }
}
