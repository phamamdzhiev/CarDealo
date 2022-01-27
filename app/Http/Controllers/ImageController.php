<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public static function uploadImages($request, $offerID)
    {
        $validator = Validator::make($request->all(), [
            'files.*' => 'bail|mimes:jpg,jpeg,png|max:4096',
        ], [
            'mimes' => 'Позлените формати на файловете са .jpeg, .jpg и .png',
            'max' => 'Позволеният размер за 1 снимка е до 4MB'
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $folderNameAsMonth = date('Ym');
                $path = $file->store($folderNameAsMonth);

                Image::create([
                    'image' => $path,
                    'offer_id' => $offerID,
                    'is_main' => 0,
                ]);
            }
        }
    }
}
