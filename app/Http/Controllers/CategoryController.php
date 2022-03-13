<?php

namespace App\Http\Controllers;

use App\Models\VehicleCategory;
use App\Models\VehicleType;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;


class CategoryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function get()
    {
        $category = Cache::remember('category', Carbon::now()->addMinutes(0), function () {
            return VehicleCategory::all();
        });

        return response()->json(
            $category
        );
    }

    /**
     * @param $category
     * @param $isPopular
     * @return JsonResponse
     */
    public function getTypes($category, $popular)
    {
        $types = VehicleType::where('category_id', '=', $category);

        if (!empty($popular)) {
            $types->where('is_popular', true);
        }
        return response()->json($types->get());
    }
}
