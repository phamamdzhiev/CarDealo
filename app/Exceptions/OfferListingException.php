<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class OfferListingException extends Exception
{
    /**
     * @param $request
     * @return Application|ResponseFactory|Response
     */
    public function render($request)
    {
        return response([
            'message' => 'Error occurs during offer listing!'
        ], 500);
    }
}
