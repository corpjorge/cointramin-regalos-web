<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::whereEmail($request->email)->first();

        if (!is_null($user) && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            $user->api_token = \Illuminate\Support\Str::random(150);
            $user->save();

            return response()->json([
                'status' => true,
                'token' => $user->api_token,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function user()
    {
        return response()->json([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'type' => auth()->user()->rol,
            'ref' => auth()->user()->id,
            'token' => auth()->user()->api_token,
        ]);
    }

    public function logout()
    {
        $user = auth()->user();
        $user->api_token = null;
        $user->save();
    }
}
