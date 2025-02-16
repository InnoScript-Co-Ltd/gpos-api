<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected function respondWithToken($token)
    {
        return $this->success('user is logged in successfully', [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ]);
    }

    public function login(LoginRequest $request)
    {
        $payload = collect($request->validated());

        try {
            if (! $token = Auth::attempt($payload->toArray())) {
                return $this->unauthenticated();
            }

            return $this->respondWithToken($token);

        } catch (Exception $e) {
            return $this->internalServerError();
        }
    }

    public function profile()
    {
        try {
            $user = auth()->user();

            return $this->success('user profile is successfully retrived', $user);
        } catch (Exception $e) {
            return $this->internalServerError();
        }
    }
}
