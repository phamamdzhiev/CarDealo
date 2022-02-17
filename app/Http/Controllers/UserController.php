<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreation;
use App\Mail\EmailVerificationCode;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|User[]
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreation $request)
    {
//        $user = User::whereEmail($request->input('email'))->first();
//
//        if (empty($user)) {
//            $user = User::create([
//                'name' => $request->name,
//                'email' => $request->email,
//                'mobile' => $request->mobile,
//                'password' => Hash::make($request->password),
//                'ip' => $request->ip()
//            ]);
//        }
//
//        Auth::login($user); // manually log the user
//        $user->createToken('api-token')->plainTextToken;
//
//        return response($user);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|User|User[]
     */
    public function show($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id): \Illuminate\Http\Response
    {
        try {
            $user = User::findOrFail((int)$id);
        } catch (NotFoundHttpException $e) {
            throw new NotFoundHttpException('Потребител с ид ' . $id . ' не съществува');
        }

        $user->password = Hash::make(request()->input('password'));
        $user->save();

        return response($user->password);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
    }


    public function isAuthenticated(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    {
        if (Auth::check()) {
            return response(Auth::user());
        } else {
            return response('no user');
        }
    }

    /**
     * @throws \Exception
     */
    public function updateMobile(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    {
        $validator = Validator::make($request->only('mobile'), [
            'mobile' => 'required|numeric|digits:10|unique:users,mobile',
        ], [
            'required' => 'Номерът е задължителен',
            'numeric' => 'Номерът трябва да бъде във формат 08xxxxxxxx',
            'digits' => 'Номерът трябва да съдържа 10 цифри',
            'unique' => 'Този номер вече съществува'
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return response(['errors' => true, 'message' => $validator->errors()], 422);
        }

        try {
            $user = User::findOrFail(Auth::id());
            $user->mobile = $request->input('mobile');
            $user->save();

            return response(['success' => true]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->only(['passwordOld', 'passwordNew']), [
            'passwordOld' => 'required',
            'passwordNew' => 'required|min:6|max:25',
        ], [
            'passwordOld.required' => 'Моля въведете старата парола',
            'passwordNew.required' => 'Моля въведете нова парола',
            'passwordNew.min' => 'Новата паролата трябва да бъде минимум 6 символа',
            'passwordNew.max' => 'Новата паролата трябва да бъде максимум 25 символа'
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return response(['errors' => true, 'message' => $validator->errors()], 422);
        }

        try {
            $user = User::findOrFail(Auth::id());
            if (Hash::check($request->input('passwordOld'), $user->password)) {
                $user->password = Hash::make($request->input('passwordNew'));
                $user->save();

                return response(['success' => true]);
            } else {
                return response(['errors' => true, 'message' => ['passwordNew' => ['Старата парола не съвпада']]], 422);
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
