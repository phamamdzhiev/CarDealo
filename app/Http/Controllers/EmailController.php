<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerificationCode;
use App\Models\EmailVerification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmailConfirmationCode(Request $request): \Illuminate\Http\JsonResponse
    {
        if (
            $request->isMethod('post') &&
            $request->has('ownerNames') &&
            $request->has('ownerEmail')
        ) {
            $ownerNames = $request->ownerNames;
            $ownerEmail = $request->ownerEmail;
            $ownerMobile = $request->ownerMobile;
        } else {
            return response()->json('Request is missing important data');
        }

        $userInstance = new User;
        $emailVerificationInstance = new EmailVerification;

        $getUser = User::select('email')->where('email', '=', $ownerEmail)->first();

        if ($getUser === null) {
            $userInstance->name = $ownerNames;
            $userInstance->email = $ownerEmail;
            $userInstance->mobile = $ownerMobile;

            $userInstance->save();
        } else {
            return response()->json(['user-exists' => 'Потребител с този имейл вече съществува!']);
        }

        $digits = 6;
        $code = rand(pow(10, $digits - 1), pow(10, $digits) - 1); //generate random 6-digits code
        $userToBeVerifiedId = User::select('id')->where('email', '=', $ownerEmail)->first();

        if ($userToBeVerifiedId !== null) {
            $emailVerificationInstance->code = $code;
            $emailVerificationInstance->expires_at = Carbon::now()->addHour(); // code is valid for 1 hour
            $emailVerificationInstance->user_id = (int)$userToBeVerifiedId->id;

            $emailVerificationInstance->save();
        }


//        Mail::to($ownerEmail)->send(new EmailVerificationCode($code));

        return response()->json(['success' => 'Code send!']);
    }
}
