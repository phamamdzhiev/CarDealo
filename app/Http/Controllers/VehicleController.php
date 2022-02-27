<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferResource;
use App\Models\Brand;
use App\Models\CarBrand;
use App\Models\CarExtra;
use App\Models\Extra;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
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
     * @return JsonResponse
     */
    public function getCarBrands(): JsonResponse
    {

        $expire = Carbon::now()->addMinutes(10);

        $carBrands = Cache::remember('brands', $expire, function () {
            return OfferResource::collection(Brand::all());
        });

        return response()->json($carBrands);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getBrandWithModels($id): JsonResponse
    {
        $carBrandWithModels = Brand::find($id)->carModels;

        return response()->json($carBrandWithModels);
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
