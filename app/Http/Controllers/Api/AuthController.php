<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validatedData =   $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);
        $validatedData['password'] = bcrypt($request->password);
        $user = User::create($validatedData);
        if ($user) {
            $loginData = $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);
                if (!auth()->attempt($loginData)) {
                    return response(['success' => false, 'message' => 'Email or Password Invalied'], 400);
                }
                $accessToken = auth()->user()->createToken('authToken')->accessToken;

                    return response(['user_info' => auth()->user(), 'token' => $accessToken], 200);

        } else {
            return response()->json(['success' => false, 'message' => 'something error signup'], 400);
        }
    }
    public function signin(Request $request)
    {
        $loginData =   $this->validate($request, [
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);

                if (!auth()->attempt($loginData)) {
                    return response(['success' => false, 'message' => 'Email or Password Invalied'], 400);
                }else{
                    $accessToken = auth()->user()->createToken('authToken')->accessToken;

                    return response(['user_info' => auth()->user(), 'token' => $accessToken], 200);
                }

    }
}
