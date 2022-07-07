<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\RegisterResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(LoginRequest $request)
    {
        $validator = $request->validated();

        if (!$token = Auth::attempt($validator)) {
            return response()->json([
                'error' => "Email atau Password salah"
            ], 401);
        }
        return $this->createNewToken($token);
    }

    public function register(RegisterRequest $request)
    {
        $validator = $request->validated();

        $user = User::create(array_merge(
            $validator,
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'success'   => true,
            'message'   => 'User berhasil didaftarkan',
            'user'      => new RegisterResource($user)
        ], 201);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(["message" => "Anda berhasil logout"]);
    }

    public function refresh()
    {
        return $this->createNewToken(Auth::refresh());
    }

    public function userProfile()
    {
        return response()->json(Auth::user());
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token'      => $token,
            'token_type'        => 'Bearer',
            'expires_in'        => Auth::factory()->getTTL() * 60 * 24,
            'user'              => Auth::user(),
        ]);
    }
}
