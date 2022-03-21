<?php

namespace App\Http\Controllers;

use App\Models\Transmission;
use Illuminate\Support\Facades\Cache;

class TransmissionController extends Controller
{
    public function get(): \Illuminate\Http\JsonResponse
    {
        $transmissions = Cache::rememberForever('transmissions', function () {
            return Transmission::all()->toArray();
        });

        return response()->json($transmissions);
    }
}
