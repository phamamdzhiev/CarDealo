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
            $request->has('ownerEmail') &&
            $request->has('ownerMobile')
        ) {
            $ownerNames = $request->ownerNames;
            $ownerEmail = $request->ownerEmail;
            $ownerMobile = $request->ownerMobile;
        } else {
            return response()->json('Request is missing important data', 404);
        }

        $userInstance = new User;
        $emailVerificationInstance = new EmailVerification;

        $getUser = User::select('email')->where('email', '=', $ownerEmail)->first();


        if (is_null($getUser)) {
            $userInstance->name = $ownerNames;
            $userInstance->email = $ownerEmail;
            $userInstance->mobile = $ownerMobile;
            $userInstance->save();

            $digits = 6;
            $code = rand(pow(10, $digits - 1), pow(10, $digits) - 1); //generate random 6-digits code
            $emailVerificationInstance->code = $code;
            $emailVerificationInstance->expires_at = Carbon::now()->addHour(); // code is valid for 1 hour
            $emailVerificationInstance->user_id = (int)$userInstance->id;

            $emailVerificationInstance->save();
            //        Mail::to($ownerEmail)->send(new EmailVerificationCode($code));
            return response()->json(['success' => 'Code send!', 'setStep' => 6]);
        } else {
            $isEmailVerified = User::select('email_verified_at')->where('id', $userInstance->id)->first();
            if (is_null($isEmailVerified)) {
                return response()->json(['warn' => 'User exists, but it is not verified', 'setStep' => 6]);
            }
            return response()->json(['success' => 'User is verified']);
        }
    }
}
