<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use Illuminate\Support\Facades\Cache;

class FuelController extends Controller
{
    public function get(): \Illuminate\Http\JsonResponse
    {
        $fuels = Cache::rememberForever('fuels',  function () {
            return \DB::table('fuels')->get()->toArray();
        });

        return response()->json($fuels);
    }
}
