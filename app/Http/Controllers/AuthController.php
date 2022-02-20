<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreation;
use App\Models\Merchant;
use App\Models\PasswordReset;
use App\Models\User;
use http\Exception\BadQueryStringException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    public function login(Request $request)
    {

        $credentials = $request->validate([
            'mobile' => 'required',
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

    /**
     * @param UserCreation $request
     * @return JsonResponse
     */
    public function register(UserCreation $request): JsonResponse
    {
        try {
            $user = User::whereMobile($request->input('mobile'))->first();

            if (empty($user)) {
                $user = User::create([
                    'name' => $request->input('names'),
                    'email' => $request->input('email'),
                    'mobile' => $request->input('mobile'),
                    'password' => Hash::make($request->input('password')),
                    'is_business' => $request->input('is_business'),
                    'ip' => $request->ip(),
                ]);

                if ($request->input('is_business')) {
                    Merchant::create([
                        'user_id' => $user->id,
                        'name' => $request->input('company'),
                        'address' => $request->input('companyAddress'),
                        'eik' => $request->input('companyEik'),
                        'domain' => null
                    ]);
                }
            }

            Auth::login($user); // manually log the user
            $user->createToken('api-token')->plainTextToken;

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error Occurs']);
        }
    }

    public function logout(Request $request): JsonResponse
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

    public function requestNewPassword(Request $request): Response|Application|ResponseFactory
    {
        $validator = Validator::make($request->only(['mobile']), [
            'mobile' => 'required|numeric|min:14'
        ],
            [
                'mobile.required' => 'Полето е задължително',
                'mobile.numeric' => 'Номерът трябва да съдържа само цифри',
                'mobile.min' => 'Въведете валиден номер',
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
                'expires_at' => Carbon::now()->addMinutes(15)
            ]);

            return response(['success' => true, 'token' => Hash::make($randomString)]);
        } catch (QueryException $e) {
            return response($e->getMessage());
        }

//        Mail::to($userEmail)->send(new EmailVerificationCode($code));

    }

    public function resetPassword(Request $request): Response|Application|ResponseFactory
    {
        $validator = Validator::make($request->only(['token', 'code', 'password', 'mobile']),
            [
                'password' => 'required|min:6|max:25',
                'token' => 'required',
                'code' => 'required|numeric|digits:6',
                'mobile' => 'required|numeric'
            ]
        );

        if ($validator->stopOnFirstFailure()->fails()) {
            return response(['errors' => true, 'message' => $validator->errors()], 422);
        }

        $user = User::whereMobile($request->input('mobile'))->first();

        $tokenFromDB = PasswordReset::select('token')
            ->where('code', '=', $request->input('code'))
            ->where('email', '=', $request->input('mobile'))
            ->where('expires_at', '>', Carbon::now())
            ->orderByDesc('id')
            ->limit(1)
            ->first();

        if ($tokenFromDB) {
            if (Hash::check($tokenFromDB->token, $request->input('token'))) {
                try {
                    $user->password = Hash::make($request->input('password'));
                    $user->save();

                } catch (QueryException $e) {
                }

                return response(['success' => true]);
            }
            return response(['errors' => true, 'message' => 'Грешка! Опитайте по-късно'], 422);
        }
        return response(['errors' => true, 'code' => 'Невалиден код'], 422);
    }
}
