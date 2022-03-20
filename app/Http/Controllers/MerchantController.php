<?php

namespace App\Http\Controllers;

use App\Exceptions\MerchantOffersListingException;
use App\Models\Merchant;
use App\Models\Repository\OfferRepository;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()
            ->json(
                ['data' => \DB::table('merchants')->select()->take(10)->orderByDesc('id')->get()->toArray()]
            );
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $offerRepository = new OfferRepository();
            $offers = $offerRepository->getSingleOfferQuery()
                ->where('merchants.id', $id)
                ->get();
            return response()->json($offers);
        } catch (\Exception $e) {
            throw new MerchantOffersListingException;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
