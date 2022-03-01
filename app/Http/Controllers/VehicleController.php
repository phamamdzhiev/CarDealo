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
    public function getBrands($category, $popular = null): JsonResponse
    {
        $carBrands = Cache::remember(
            sprintf('brands_%s_%s', $category, $popular), Carbon::now()->addMinutes(10),
            function () use ($category, $popular){
                return Brand::whereHas('category', function ($q) use ($category, $popular) {
                    if ($popular !== null) {
                        /**
                         * @var $q Builder
                         */
                        $q->where('brands.is_popular', '=', $popular)
                            ->take(10);
                    }
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
                return VehicleModel::whereHas('category', function (\Illuminate\Database\Eloquent\Builder $q) use ($category, $brand) {
                    return $q
                        ->where('category_id', $category)
                        ->where('brand_id', $brand);
                })->get();
            });

        return response()->json($carBrands);
    }

    /**
     * @param $category
     * @return JsonResponse
     */
    public function getCarExtras($category): JsonResponse
    {
        $expire = Carbon::now()->addMinutes(10);

        $carExtras = Cache::remember(sprintf('extras_%s', $category), $expire, function () use ($category) {
            return Extra::whereHas('category', function (\Illuminate\Database\Eloquent\Builder $q) use ($category) {
                return $q
                    ->where('category_id', $category);
            })->get();
        });

        return response()->json($carExtras);
    }
}
