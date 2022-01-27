<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferCreationRequest;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $userEmail = $request->input('email');

        Validator::make($offerData, [
            'new_or_used' => 'required',
            'car_brand' => 'required',
            //add rest of validations...
        ]);

        $user = User::whereEmail($userEmail)->first();

        $offer = Offer::create([
            'is_new' => $offerData['new_or_used'],
            'car_brands_id' => 1,
            'car_models_id' => 4,
            'title' => $offerData['car_offer_title'],
            'description' => $offerData['car_offer_description'],
            'price' => $offerData['car_price'],
            'km' => $offerData['car_km'],
            'hp' => $offerData['car_hp'],
            'cm3' => $offerData['car_cm3'],
            'year' => $offerData['car_year'],
            'fuel' => 1,
            'transmission' => 1,
            'color' => 1,
            'coupe_type' => 1,
            'year_acquired' => 0,
            'user_id' => $user->id
        ]);

        $image = ImageController::uploadImages($request, $offer->id);

        return response($image);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Offer $offer
     * @return Offer[]|\Illuminate\Database\Eloquent\Collection
     */
    public function show(Offer $offer)
    {
        return $offer->all();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function showApproved(Offer $offer)
    {
        return $offer->approved()->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        //
    }
}
