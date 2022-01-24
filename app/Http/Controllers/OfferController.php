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
        /** @var User $user */
        $user = User::whereEmail($request->input('ownerEmail'))->first();

        if (empty($user)) {
            User::create([
                'name' => $request->input('ownerNames'),
                'mobile' => $request->input('ownerMobile'),
                'email' => $request->ownerEmail,
                'password' => Hash::make($request->ownerPassword),
                'is_business' => 0
            ]);
        }
    }

    /**
     * @throws AuthException
     * @throws \Exception
     */
    public function createOffer(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    {
        $request->validate([
            'ownerNames' => 'required',
            'ownerEmail' => 'required',
            'ownerMobile' => 'required',
            'ownerPassword' => 'required',
        ]);

        $this->saveUser($request);
//        $allOfferData = $request->input('allData');




        return \response('ok', 200);
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
