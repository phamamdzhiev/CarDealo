<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function uploadImage(\Illuminate\Http\Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::whereEmail($request->input('userEmail'))->first();

//        dump($user->email);
//        dump($user->password);

//        $jwt = $user->createToken('api token')->plainTextToken;

//        Cookie::make('jwt', $jwt, 24 * 60);
//        die;
        $a = Auth::attempt(['email' => $user->email, 'password' => $user->password]);
        dump($a);

        die;

        $validator = Validator::make($request->all(), [
//            'car_offer_title' => 'required|max:5',
            'files.*' => 'bail|mimes:jpg,jpeg,png|max:4096',
        ], [
            'mimes' => 'Позлените формати на файловете са .jpeg, .jpg и .png',
            'max' => 'Позволеният размер за 1 снимка е до 4MB'
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->input('userEmail') &&
            $request->has('offer') &&
            $request->hasFile('files')
        ) {
            $user = User::whereEmail($request->input('userEmail'))->first();

            $offer = json_decode($request->input('offer'));
            $a = Offer::create([
                'is_new' => $offer->new_or_used,
                'car_brands_id' => 1,
                'car_models_id' => 4,
                'title' => $offer->car_offer_title,
                'description' => $offer->car_offer_description,
                'price' => $offer->car_price,
                'km' => $offer->car_km,
                'hp' => $offer->car_hp,
                'cm3' => $offer->car_cm3,
                'year' => $offer->car_year,
                'fuel' => 1,
                'transmission' => 1,
                'color' => 1,
                'coupe_type' => 1,
                'year_acquired' => 0,
                'user_id' => $user->id
            ]);

            foreach ($request->file('files') as $file) {
                $folderNameAsMonth = date('Ym');
                $path = $file->store($folderNameAsMonth);

                Image::create([
                    'image' => $path,
                    'is_main' => 0,
                    'offer_id' => $a->id,
                ]);
            }

        }
        return response()->json(['res' => 'Images uploaded'], 302);
    }
}
