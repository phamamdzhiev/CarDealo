<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreation;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'bail|required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(['user' => Auth::getUser()]);
        } else {
            return response(['error' => true, 'message' => 'Грешни данни за вход. Опитайте отново!']);
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

        return response()->json(['success' => true]);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        try {
            Auth::guard('web')->logout();
            $success = true;
            $message = 'Successfully logged out!';
        }catch (QueryException $e) {
            $success = false;
            $message = $e->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);
    }
}
