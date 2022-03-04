<?php

namespace App\Http\Controllers;

use App\Events\OfferVisited;
use App\Http\DataPersisters\OfferPersister;;

use App\Http\Requests\OfferCreationRequest;
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
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
           return response(['message' => 'Error occurs'], 500);
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
     * @param $id
     * @return JsonResponse
     */
    public function showSingle($id, Request $request): JsonResponse
    {
        try {
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
                ->findOrFail((int)$id);

            event(new OfferVisited($offer, $request->ip()));
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
     * @return Builder[]|Collection|Offer[]
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
     * @return Response
     */
    public function update(Request $request, Offer $offer)
    {
        //
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
    public function userListing(): JsonResponse
    {
        try {
            $offers = Offer::with('images')->where('user_id', Auth::id())->get();
            return response()->json(['success' => true, 'offers' => $offers]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
