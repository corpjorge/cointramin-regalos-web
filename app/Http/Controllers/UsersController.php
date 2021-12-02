<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function usersFind($user = NULL): ?string
    {
        if (strlen($user) >= 4) {
            return \DB::table('users')
                ->where('rol', '=', 3)
                ->where(function ($query) use ($user) {
                    $query->orWhere('name', 'like', "%$user%")
                        ->orWhere('email', 'like', "%$user%")
                        ->orWhere('document', 'like', "%$user%");
                })->get(['id', 'name', 'document', 'email', 'deleted_at']);
        } else {
            return null;
        }
    }

    public function index(): mixed
    {
        return User::where('rol', 2)->limit(10)->latest('updated_at')->get(['id', 'name', 'email']);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->rol = 2;
        $user->password = Hash::make($request->password);
        $user->save();
    }

    public function edit($user)
    {
        return User::find($user);
    }

    public function update(Request $request, $user)
    {
        User::find($user);
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
    }

    public function destroy(User $user)
    {
        $user->delete();
    }

}
