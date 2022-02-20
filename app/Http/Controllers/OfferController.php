<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferCreationRequest;
use App\Models\Offer;
use App\Models\User;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Psy\Input\CodeArgument;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $offerData = json_decode($request->input('offer'), true);

        Validator::make($offerData, [
            'new_or_used' => 'required',
            'car_brand' => 'required',
            //add rest of validations...
        ]);

        $offer = Offer::create([
            'is_new' => $offerData['new_or_used'],
            'car_brands_id' => 314,
            'car_models_id' => 2038,
            'title' => $offerData['car_offer_title'],
            'description' => $offerData['car_offer_description'],
            'price' => $offerData['car_price'] ?? 0,
            'km' => $offerData['car_km'],
            'hp' => $offerData['car_hp'],
            'cm3' => $offerData['car_cm3'],
            'year' => $offerData['car_year'],
            'fuel' => $offerData['car_fuel'],
            'transmission' => 1,
            'color' => 1,
            'coupe_type' => 1,
            'year_acquired' => 0,
            'user_id' => \Auth::id()
        ]);

        $image = ImageController::uploadImages($request, $offer->id);

        return response($image);
    }

    /**
     * Display the specified resource.
     *
     * @param Offer $offer
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder[]
     */
    public function show(Offer $offer, Request $request): array|\Illuminate\Database\Eloquent\Collection
    {
        return $offer->with('images')->take(10)->get();
    }

    public function showSingle($id): \Illuminate\Http\JsonResponse
    {
        try {
            $offer = Offer::findOrFail((int)$id);
            $response = [
                'success' => true,
                'data' => $offer
            ];
        } catch (NotFoundHttpException $exception) {
            $response = [
                'error' => true,
                'message' => $exception->getMessage()
            ];
        }


        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param Offer $offer
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Offer[]
     */
    public function showApproved(Offer $offer)
    {
        return $offer->approved()->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws Exception
     */
    public function destroy($id)
    {
        $offer = Offer::findOrFail((int)$id);

        if (Auth::id() !== $offer->user_id) {
            abort(401, 'Unauthorized');
        }

        try {

            foreach ($offer->images as $image) {
                Storage::delete($image->image);
            }

            $offer->delete();

            return response(['success' => true]);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }


    /**
     * @throws Exception
     */
    public function userListing(): \Illuminate\Http\JsonResponse
    {
        try {
            $offers = Offer::whereUserId(Auth::id())->get();
            return response()->json(['success' => true, 'offers' => $offers]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
