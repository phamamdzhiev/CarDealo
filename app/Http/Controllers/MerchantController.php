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
        $merchants = \DB::table('merchants')
            ->select()
            ->take(10)
            ->orderByDesc('id')
            ->get()
            ->toArray();

        return response()->json($merchants);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $offerRepository = new OfferRepository();
            $merchant = Merchant::findOrFail($id);
            $offers = $offerRepository->getSingleOfferQuery()
                ->where('merchants.id', $id)
                ->get()
                ->toArray();
            return response()->json(['offers' => $offers, 'merchant' => $merchant]);
        } catch (\Exception $e) {
            throw new MerchantOffersListingException;
        }
    }

    public function getAuthMerchant(): JsonResponse
    {
        $userMerchant = User::findOrFail(\Auth::id())->merchant()->first();

        return \response()->json($userMerchant);
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
