<?php

namespace App\Http\Controllers;

use App\Http\DataPersisters\OfferPersister;;
use App\Models\Offer;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
    public function store(Request $request, OfferPersister $persister)
    {
        $offerData = json_decode($request->input('offer'), true);
        /*Validator::make($offerData, [
            'new_or_used' => 'required',
            'car_brand' => 'required',
            //add rest of validations...
        ]);*/
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
     * Display the specified resource.
     *
     * @param Offer $offer
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder[]
     */
    public function show(Offer $offer, Request $request): array|\Illuminate\Database\Eloquent\Collection
    {
        return $offer->with('images')->take(10)->get();
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function showSingle($id): JsonResponse
    {
        try {
            $response = [
                'success' => true,
                'data' => Offer::with('images')
                    ->with('user:id,name,mobile')
                    ->with('vehicle')
                    ->with('vehicle.transmission')
                    ->with('vehicle.fuel')
                    ->with('vehicle.extras')
                    ->with('city')
                    ->with('city.region')
                    ->findOrFail((int)$id)
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
