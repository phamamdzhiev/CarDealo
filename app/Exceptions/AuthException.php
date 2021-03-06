<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class AuthException extends Exception
{

    /**
     * @param $request
     * @return Application|ResponseFactory|Response
     */
    public function render($request)
    {
        return response([
            'message' => 'Unauthorized!'
        ], 401);
    }
}
