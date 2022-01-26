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

    }

    /**
     * @throws AuthException
     * @throws \Exception
     */
    public function createOffer(Request $request)
    {
        $request->validate([
            'ownerEmail' => 'required',
            'ownerPassword' => 'required'
        ]);

//        $user = User::whereEmail($request->ownerEmail)->first();
//        dump(Hash::check($request->ownerPassword, $user->password)); die;
//
//        if (!$user || !Hash::check($request->ownerPassword, $user->password)) {
//
//            return response(['auth' => 'failed'], 401);
//        }

//        /** @var User $user */
//        $user = User::whereEmail($request->input('ownerEmail'))->first();
//
//        if (empty($user)) {
//            $user = User::create([
//                'name' => $request->input('ownerNames'),
//                'mobile' => $request->input('ownerMobile'),
//                'email' => $request->ownerEmail,
//                'password' => Hash::make($request->ownerPassword),
//                'is_business' => 0
//            ]);
//        }
//
        $token = $user->createToken('myapitoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
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
