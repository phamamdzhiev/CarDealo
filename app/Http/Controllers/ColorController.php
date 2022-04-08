<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ColorController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        $colors = Cache::rememberForever('colors', function () {
            return \DB::table('colors')->get()->toArray();
        });

        return response()->json($colors);
    }
}
