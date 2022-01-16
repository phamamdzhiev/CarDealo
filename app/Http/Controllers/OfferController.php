<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferResource;
use App\Models\Offer;
use App\Models\CarBrand;
use App\Models\CarExtra;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use ImageKit\ImageKit;
use ImageKit\Utils\Response;

class OfferController extends Controller
{
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

    public function getCarExtras(): \Illuminate\Http\JsonResponse
    {
        $expire = Carbon::now()->addCenturies(10);

        $carExtras = Cache::remember('car_extras', $expire, function () {
            return CarExtra::all();
        });

        return response()->json([
            'car_extras' => $carExtras
        ]);
    }
}


//
//            $uploadToKit = new ImageKit(
//                env('IMAGE_KIT_PUBLIC'),
//                env('IMAGE_KIT_PRIVATE'),
//                env('IMAGE_KIT_URL')
//            );

//            $path = public_path('images');
//                $filename = $file->getClientOriginalName();
//
//                $imagePath = $path . DIRECTORY_SEPARATOR . $filename;
//
//                /**
//                 * @var $res Response
//                 */
//                $uploadToKit->upload([
//                    'file' => fopen($imagePath, 'r'),
//                    'fileName' => $filename,
//                    'folder' => date('Y-m')
//                ]);
//
//                unlink($imagePath);
