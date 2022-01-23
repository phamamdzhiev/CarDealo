<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferResource;
use App\Models\CarBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response as Response;

class CarBrandController extends Controller
{
    public function searchCarBrands(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('keyword')) {
            return response()->json('Bad Request', Response::HTTP_BAD_REQUEST);
        }

        $data = CarBrand::where('name', 'LIKE', '%' . $request->keyword . '%')->get();
        return \response()->json(['success' => $data]);
    }

    public function getPopularCarBrandsWithLimit(): \Illuminate\Http\JsonResponse
    {
        $expire = Carbon::now()->addMinutes(10);

        $popularCarBrands = Cache::remember('car_brands', $expire, function () {
            return OfferResource::collection(CarBrand::where('is_popular', 1)->orderBy('id')->take(10)->get());
        });

        return response()->json([
            'popularCarBrands' => $popularCarBrands
        ]);
    }

    public function getCarBrands(): \Illuminate\Http\JsonResponse
    {

        $expire = Carbon::now()->addMinutes(10);

        $carBrands = Cache::remember('car_brands', $expire, function () {
            return OfferResource::collection(CarBrand::all());
        });

        return response()->json([
            'car_brands' => $carBrands
        ]);
    }

    public function getBrandWithModels($id): \Illuminate\Http\JsonResponse
    {
        $carBrandWithModels = CarBrand::find($id)->carModels;

        return response()->json([
            'car_brand_with_models' => $carBrandWithModels
        ]);
    }
}
