<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer',]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(
                    [
                        'status' => false,
                        'message' => 'Email atau Password Salah'
                    ]
                    ,
                    401
                );
        }

        $user = User::where('email', $request['email'])->first();
        $check = Hash::check($request->password, $user->password);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()
            ->json([
                'status' => true,
                'message' => 'Berhasil Login',
                'token_type' => 'Bearer',
                'access_token' => 'Bearer ' . $token,
            ]);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'status' => true,
            'message' => 'Berhasil Logout'
        ];
    }
    
    public function check(){
        return [
            'status' => true,
            'message' => 'Berhasil Mendapatkan Data',
            // 'data' => (auth()->user())
            'data' => new UserResource(User::where('id',auth()->user()->id)->first())
        ];
    }
}