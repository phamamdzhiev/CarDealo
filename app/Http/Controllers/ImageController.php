<?php

namespace App\Http\Controllers;

use App\Exceptions\AuthException;
use App\Models\Image;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
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

    /**
     * @param \Illuminate\Http\Request $request
     * @return string
     * @throws \Exception
     */
    public function destroy(\Illuminate\Http\Request $request): string
    {
        try {
            if (Auth::id() !== $request->input('userID')) {
                throw new AuthException;
            }

            $image = Image::findOrFail($request->input('id'));
            Storage::delete($image->image);
            $image->delete();

            return response()->json(['success' => true]);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
