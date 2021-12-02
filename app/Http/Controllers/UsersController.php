<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function usersFind($user = NULL): ?string
    {
        if (strlen($user) >= 4) {
            return \DB::table('users')
                ->where('role_id', '=', 4)
                ->where(function ($query) use ($user) {
                    $query->orWhere('name', 'like', "%$user%")
                        ->orWhere('email', 'like', "%$user%")
                        ->orWhere('document', 'like', "%$user%");
                })->get(['id', 'name', 'document', 'email', 'deleted_at']);
        } else {
            return null;
        }
    }

    public function index(User $user): mixed
    {
        return $user->where('role_id', 4)->limit(10)->latest('updated_at')->get(['id', 'name', 'email']);
    }

    public function store(UserRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->role_id = 4;
        $user->password = Hash::make(rand());
        $user->save();
    }

    public function edit(User $user)
    {
        if ($user->role_id == 4) {
            return $user;
        }
    }

    public function update(UserRequest $request, User $user)
    {
        if ($user->role_id == 4)
            $user->update($request->all());
    }

    public function destroy(User $user)
    {
        $user->delete();
    }

}
