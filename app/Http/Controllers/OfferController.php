<?php

namespace App\Http\Controllers;

use App\Events\OfferVisited;
use App\Exceptions\AuthException;
use App\Exceptions\DeleteOfferException;
use App\Exceptions\OfferCreationException;
use App\Exceptions\OfferListingException;
use App\Exceptions\OfferNotFoundException;
use App\Exceptions\OfferUpdateFailedException;
use App\Http\DataPersisters\OfferPersister;;

use App\Http\DataPersisters\OfferUpdate;
use App\Models\Offer;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    /**
     * @param Request $request
     * @param OfferPersister $persister
     * @return Application|ResponseFactory|Response
     * @throws \Throwable
     */
    public function store(Request $request, OfferPersister $persister)
    {
        DB::beginTransaction();
        try {
            $offer = $persister->persist();
            $image = ImageController::uploadImages($request, $offer->id);
            DB::commit();
            return response($image);
        } catch (\Exception $e) {
            DB::rollBack();
           throw new OfferCreationException;
        }

    }

    /**
     * @param Offer $offer
     * @param Request $request
     * @return array|Collection
     */
    public function show(Offer $offer, Request $request): array|Collection
    {
        return $offer->with('images')->take(10)->get();
    }

    /**
     * @param $uid
     * @param Request $request
     * @return JsonResponse
     */
    public function showSingle($uid, Request $request): JsonResponse
    {
        /**
         * @var $offer Offer
         */
        $offer = Offer::with('images')
            ->with('user:id,name,mobile')
            ->with('vehicle')
            ->with('vehicle.transmission')
            ->with('vehicle.fuel')
            ->with('vehicle.extras')
            ->with('city')
            ->with('city.region')
            ->where('uid', $uid)
            ->first();

        if (empty($offer)) {
            throw new OfferNotFoundException;
        }

        event(new OfferVisited($offer, $request->ip()));

        return response()->json([
            'success' => true,
            'data' => $offer
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Offer $offer
     * @return Builder[]|Collection|Offer[]
     */
    public function showApproved(Offer $offer)
    {
        return $offer->approved()->get();
    }

    /**
     * @param $uid
     * @param OfferUpdate $offerUpdate
     * @return Application|ResponseFactory|Response
     * @throws AuthException
     * @throws OfferUpdateFailedException|OfferNotFoundException
     */
    public function update($uid, OfferUpdate $offerUpdate): Response|Application|ResponseFactory
    {
        $offer = Offer::where('uid','=', $uid)->where('user_id', '=',Auth::id())->first();

        if (Auth::id() !== $offer->user_id) {
            throw new AuthException;
        }

        if (empty($offer)) {
            throw new OfferNotFoundException;
        }

        if ($offerUpdate->update($offer)) {
            return response(['success' => true, 'message'   =>  'Offer updated successfully'], 200);
        }

        throw new OfferUpdateFailedException;
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return Application|ResponseFactory|Response
     * @throws Exception
     */
    public function destroy($id)
    {
        $offer = Offer::findOrFail((int)$id);

        if (Auth::id() !== $offer->user_id) {
            throw new AuthException;
        }

        try {
            foreach ($offer->images as $image) {
                Storage::delete($image->image);
            }
            $offer->delete();
            return response(['success' => true]);
        } catch (Exception $exception) {
            throw new DeleteOfferException;
        }
    }


    /**
     * @throws Exception
     */
    public function userListing(): JsonResponse
    {
        try {
            $offers = Offer::with('images')->where('user_id', Auth::id())->get();
            return response()->json(['success' => true, 'offers' => $offers]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
           throw new OfferListingException;
        }
    }
}
