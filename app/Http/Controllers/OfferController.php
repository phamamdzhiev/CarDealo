<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\CarBrand;
use App\Models\CarExtra;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function getCarBrands(): \Illuminate\Http\JsonResponse
    {

        $expire = Carbon::now()->addMinutes(10);

        $carBrands = Cache::remember('car_brands', $expire, function () {
            return CarBrand::all();
        });

        return response()->json([
            'car_brands' => $carBrands,
        ]);
    }

    public function getBrandWithModels($id): \Illuminate\Http\JsonResponse
    {
        $carBrandWithModels = CarBrand::find($id)->carModels;

        return response()->json([
            'car_brand_with_models' => $carBrandWithModels
        ]);
    }

    public function getCarExtras(): \Illuminate\Http\JsonResponse
    {
        $expire = Carbon::now()->addMinutes(10);

        $carExtras = Cache::remember('car_extras', $expire, function () {
            return CarExtra::all();
        });

        return response()->json([
            'car_extras' => $carExtras
        ]);
    }

    public function setDataApi(\Illuminate\Http\Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->hasFile('files')) {

            foreach ($request->file('files') as $file) {
                $filename = '/images/' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
            }
        }


        return response()->json(['res' => 'Images added']);
    }
}
