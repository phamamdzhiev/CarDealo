<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreation;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection|User[]
     */
    public function index(): Collection|array
    {
        return User::all();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Collection|Model|User|User[]
     */
    public function show(int $id): Model|Collection|array|User
    {
        return User::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(int $id): Response
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
     * @return void
     */
    public function destroy(int $id)
    {
        User::destroy($id);
    }


    public function isAuthenticated(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
    {
        if (Auth::check()) {
            return response(Auth::user());
        } else {
            return response('no user');
        }
    }
}
