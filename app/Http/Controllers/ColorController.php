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
    public function get()
    {
        $colors = Cache::rememberForever('colors',  function () {
            return Color::all();
        });

        return response()->json(['success' => true, 'data' => $colors]);
    }
}
