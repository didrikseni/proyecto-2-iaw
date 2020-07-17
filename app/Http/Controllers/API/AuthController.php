<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);
        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(json_encode(['userData' =>[ 'user' => $user, 'access_token' => $accessToken]]), 200);
    }

    public function login(Request $request) {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials'], 401);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(json_encode(['userData' => ['user' => auth()->user(), 'access_token' => $accessToken]]), 200);
    }

    public function logged_in(Request $request) {
        if (DB::table('oauth_access_tokens')->where('user_id', '=', $request->user_id)->exists()){
            return response(json_encode(['userData' => auth()->user()]), 200);
        } else {
            return response(['message' => 'Not logged in'], 418);
        }
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
}

}
