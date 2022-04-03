<?php

namespace App\Http\Controllers;

use App\Models\Fraud;
use Exception as FraudErrorMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FraudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws FraudErrorMessage
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|max:2000',
            'offerID' => 'required'
        ]);

        try {
            Fraud::create([
                'email' => $request->input('email'),
                'message' => $request->input('message'),
                'offer_id' => $request->input('offerID')
            ]);

            return response()->json(['success' => true]);
        } catch (FraudErrorMessage $e) {
            throw new FraudErrorMessage($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
