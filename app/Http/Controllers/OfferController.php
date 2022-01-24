<?php

namespace App\Http\Controllers;

use App\Exceptions\AuthException;
use App\Http\Resources\OfferResource;
use App\Models\CarBrand;
use App\Models\CarExtra;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as Response;

class OfferController extends Controller
{
    /**
     * @throws AuthException
     * @var Request $request
     */
    private function saveUser($request)
    {
        try {
            /** @var User $user */
            $user = User::whereEmail($request->input('ownerEmail'))->first();
//            dump($request->allData['car_offer_owner']['is_owner_business']); die;
            if (empty($user)) {
                $user = User::create([
                    'name' => $request->input('ownerNames'),
                    'mobile' => $request->input('ownerMobile'),
                    'email' => $request->ownerEmail,
                    'password' => Hash::make($request->ownerPassword),
                    'is_business' => $request->allData['car_offer_owner']['is_owner_business']
                ]);
            }
        } catch (AuthException $exception) {
            throw $exception;
        } catch (\Throwable $exception) {
            throw new AuthException('Auth failed!');
        }
    }

    /**
     * @throws AuthException
     * @throws \Exception
     */
    public function createOffer(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'ownerNames' => 'required',
            'ownerEmail' => 'required',
            'ownerMobile' => 'required',
            'ownerPassword' => 'required',
        ]);

        $this->saveUser($request);
        $allOfferData = $request->input('allData');

            Offer::create([
                'is_new' => $allOfferData['new_or_used'],
                'car_brands_id' => 1,
                'car_models_id' => 4,
                'title' => $allOfferData['car_offer_title'],
                'description' => $allOfferData['car_offer_description'],
                'price' => $allOfferData['car_price'],
                'km' => $allOfferData['car_km'],
                'hp' => $allOfferData['car_hp'],
                'cm3' => $allOfferData['car_cm3'],
                'year' => $allOfferData['car_year'],
                'fuel' => 1,
                'transmission' => 1,
                'color' => 1,
                'coupe_type' => 1,
                'year_acquired' => 0,
            ]);


        return \response()->json('ok');
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
