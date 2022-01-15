<?php

namespace App\Http\Controllers;

use ImageKit\ImageKit;

class ImageKitController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {

        $imageKit = new ImageKit(
            env('IMAGE_KIT_PUBLIC'),
            env('IMAGE_KIT_PRIVATE'),
            env('IMAGE_KIT_URL')
        );


        $listFiles = $imageKit->listFiles(array(
            'skip' => 0,
            'limit' => 5,
        ))->success;

        return response()->json($listFiles, 200);
    }
}
