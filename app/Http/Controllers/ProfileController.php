<?php

namespace App\Http\Controllers;

use App\Exceptions\AuthException;
use App\Models\Merchant;
use App\Models\User;
use Exception as ExceptionAlias;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\Translation\t;

class ProfileController extends Controller
{

    /**
     * @throws ExceptionAlias
     */

    public function updateMobile(Request $request): Application|ResponseFactory|Response
    {
        $validator = Validator::make($request->only('mobile'), [
            'mobile' => 'required|unique:users,mobile',
        ], [
            'required' => 'Номерът е задължителен',
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
        } catch (ExceptionAlias $e) {
            throw new ExceptionAlias($e->getMessage());
        }
    }

    /**
     * @throws ExceptionAlias
     */
    public function updatePassword(Request $request): Response|Application|ResponseFactory
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

        } catch (ExceptionAlias $e) {
            throw new ExceptionAlias($e->getMessage());
        }
    }

    public function uploadAvatar(Request $request)
    {
        $requestUser = json_decode($request->input('user'));

        if (Auth::id() !== $requestUser->id) {
            throw new AuthException;
        }

        $merchant = Merchant::whereUserId($requestUser->id)->first();

        if ($request->hasFile('avatar')) {
            try {
                if (isset($merchant->image)) {
                    Storage::delete($merchant->image);
                }

                $file = $request->file('avatar');
                $fileName = $file->store('merchants-avatars');

                $merchant->image = $fileName;
                $merchant->save();

                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }

    public function updateDescription(Request $request) {
        $requestUser = $request->input('user');
        $description = $request->input('description');

        $request->validate(['description' => 'max:750']);

        if (Auth::id() !== $requestUser['id']) {
            throw new AuthException;
        }

        $merchant = Merchant::whereUserId($requestUser['id'])->first();

        try {
            $merchant->description = $description;
            $merchant->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
