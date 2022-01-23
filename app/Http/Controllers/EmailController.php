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
        $digits = 6;
        $code = rand(pow(10, $digits - 1), pow(10, $digits) - 1); //generate random 6-digits code
        $user = User::select('id')->where('email', $request->input('email'))->first();

        EmailVerification::create([
            'code' => $code,
            'expires_at' => Carbon::now()->addHour(),
            'user_id' => $user->value('id')
        ]);

//        Mail::to($request->email)->send(new EmailVerificationCode($code));

        return response()->json(['success' => 'Code has been sent!']);
    }


    public function confirmEmail(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::whereEmail($request->input('email'))->first();

        /** @var EmailVerification $codeFromDb */
        $codeFromDb = EmailVerification::select('code')->where('user_id', $user->id)->first();

        if ($codeFromDb->code === $request->input('code')) {
            $updateUser = new User;
            $updateUser->email_verified_at = Carbon::now();
            $updateUser->save();

            return response()->json('success');
        } else {
            return response()->json(['error' => 'Codes do not match!']);
        }
    }
}
