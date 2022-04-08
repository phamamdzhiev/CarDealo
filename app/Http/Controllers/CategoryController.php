<?php

namespace App\Http\Controllers;

use App\Models\VehicleCategory;
use App\Models\VehicleType;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        $category = Cache::remember('category', Carbon::now()->addMinutes(0), function () {
            return DB::table('vehicles_category')->get();
        });

        return response()->json(
            $category
        );
    }

    /**
     * @param $category
     * @param null $popular
     * @return JsonResponse
     */
    public function getTypes($category, $popular = null): JsonResponse
    {
        $types =  DB::table('vehicles_types')->where('category_id', '=', $category);

        if (!empty($popular)) {
            $types->where('is_popular', true);
        }

        return response()->json($types->get());
    }
}
