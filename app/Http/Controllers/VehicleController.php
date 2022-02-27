<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferResource;
use App\Models\Brand;
use App\Models\CarBrand;
use App\Models\CarExtra;
use App\Models\CategoryBrandModel;
use App\Models\Extra;
use App\Models\VehicleModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class VehicleController extends Controller
{

    /**
     * @param Request $request
     * @return Response|JsonResponse|Application|ResponseFactory
     */
    public function searchCarBrands(Request $request): Response|JsonResponse|Application|ResponseFactory
    {
        return response()
            ->json(Brand::where('name', 'LIKE', '%' . $request->input('keyword') . '%')
            ->get()
            );
    }

    /**
     * @return JsonResponse
     */
    public function getPopularCarBrandsWithLimit(): JsonResponse
    {
        $expire = Carbon::now()->addMinutes(10);
        $popularCarBrands = Cache::remember('brands', $expire, function () {
            return OfferResource::collection(Brand::whereIsPopular(1)
                ->orderBy('id')
                ->take(10)
                ->get()
            );
        });

        return response()->json($popularCarBrands);
    }

    /**
     * @param $category
     * @return JsonResponse
     */
    public function getCarBrands($category): JsonResponse
    {
        $carBrands = Cache::remember(
            sprintf('brands_%s', $category), Carbon::now()->addMinutes(10),
            function () use ($category){
                return Brand::whereHas('category', function ($q) use ($category) {
                    return $q->where('category_id', $category);
                })->get();
        });

        return response()->json($carBrands);
    }

    /**
     * @param $brand
     * @param $category
     * @return JsonResponse
     */
    public function getBrandWithModels($brand, $category): JsonResponse
    {

        $carBrands = Cache::remember(
            sprintf('brand_category_models_%s_%s', $category, $brand), Carbon::now()->addMinutes(10),
            function () use ($category, $brand){
                return VehicleModel::whereHas('category', function (Builder $q) use ($category, $brand) {
                    return $q
                        ->where('category_id', $category)
                        ->where('brand_id', $brand);
                })->get();
            });

        return response()->json($carBrands);
    }

    /**
     * @return JsonResponse
     */
    public function getCarExtras(): JsonResponse
    {
        $expire = Carbon::now()->addMinutes(10);

        $carExtras = Cache::remember('extras', $expire, function () {
            return Extra::all();
        });

        return response()->json($carExtras);
    }
}
