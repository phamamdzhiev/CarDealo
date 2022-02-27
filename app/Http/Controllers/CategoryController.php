<?php

namespace App\Http\Controllers;

use App\Models\VehicleCategory;
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
}
