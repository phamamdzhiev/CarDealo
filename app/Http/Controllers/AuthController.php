<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreation;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
     * @param \Illuminate\Http\Request $request
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


    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required'
        ]);

        try {
            if (Auth::guard('web')->attempt($credentials)) {
                $request->session()->regenerate();

                $user = Auth::user();
                $token = $user->createToken('login-token')->plainTextToken;
                return response()->json(['user' => $user, 'token' => $token]);
            } else {
                return response(['error' => true, 'message' => 'Грешни данни за вход. Опитайте отново!'], 401);
            }
        } catch (QueryException $e) {
            throw new \Error($e->getMessage());
        }
    }

    public function register(UserCreation $request): \Illuminate\Http\JsonResponse
    {
        $user = User::whereEmail($request->input('email'))->first();

        if (empty($user)) {
            $user = User::create([
                'name' => $request->names,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
                'ip' => $request->ip()
            ]);
        }

        Auth::login($user); // manually log the user
        $user->createToken('api-token')->plainTextToken;

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $success = true;
            $message = 'Successfully logged out!';
        } catch (QueryException $e) {
            $success = false;
            $message = $e->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);
    }

    public function requestNewPassword(Request $request): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $validator = Validator::make($request->only(['mobile']), [
            'mobile' => 'required|numeric|exists:users'
        ],
            [
                'mobile.required' => 'Полето е задължително',
                'mobile.numeric' => 'Номерът трябва да съдържа само цифри',
                'mobile.exists' => 'Този номер не същестува'
            ]
        );

        if ($validator->stopOnFirstFailure()->fails()) {
            return response(['error' => true, 'message' => $validator->errors()], 422);
        }


        $digits = 6;
        $code = rand(pow(10, $digits - 1), pow(10, $digits) - 1); //generate random 6-digits code
        $randomString = \Str::random(64);
        try {
            PasswordReset::create([
                'email' => $request->input('mobile'),
                'token' => $randomString,
                'code' => $code,
                'created_at' => Carbon::now(),
                'expires_at' => Carbon::now()->addHour()
            ]);

            return response(['success' => true, 'token' => Hash::make($randomString)]);
        } catch (QueryException $e) {
            return response($e->getMessage());
        }

//        Mail::to($userEmail)->send(new EmailVerificationCode($code));

    }

    public function resetPassword(Request $request)
    {
        dump((int)$request->code);
    }
}
