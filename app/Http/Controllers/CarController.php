<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferResource;
use App\Models\CarBrand;
use App\Models\CarExtra;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class CarController extends Controller
{

    public function searchCarBrands(Request $request): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return response()
            ->json(CarBrand::where('name', 'LIKE', '%' . $request->input('keyword') . '%')
            ->get()
            );
    }

    public function getPopularCarBrandsWithLimit(): \Illuminate\Http\JsonResponse
    {
        $expire = Carbon::now()->addMinutes(10);

        $popularCarBrands = Cache::remember('car_brands', $expire, function () {
            return OfferResource::collection(CarBrand::whereIsPopular(1)
                ->orderBy('id')
                ->take(10)
                ->get()
            );
        });

        return response()->json($popularCarBrands);
    }

    public function getCarBrands(): \Illuminate\Http\JsonResponse
    {

        $expire = Carbon::now()->addMinutes(10);

        $carBrands = Cache::remember('car_brands', $expire, function () {
            return OfferResource::collection(CarBrand::all());
        });

        return response()->json($carBrands);
    }

    public function getBrandWithModels($id): \Illuminate\Http\JsonResponse
    {
        $carBrandWithModels = CarBrand::find($id)->carModels;

        return response()->json($carBrandWithModels);
    }

    public function getCarExtras(): \Illuminate\Http\JsonResponse
    {
        $expire = Carbon::now()->addMinutes(10);

        $carExtras = Cache::remember('car_extras', $expire, function () {
            return CarExtra::all();
        });

        return response()->json($carExtras);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
