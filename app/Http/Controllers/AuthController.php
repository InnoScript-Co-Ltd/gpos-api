<?php

namespace App\Http\Controllers;

use App\Enums\UserStatusEnum;
use App\Http\Requests\LoginRequest;
use App\Models\User;
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

            $user = User::where(['email' => $payload['email']])->first();

            if ($user === null) {
                return $this->notFound('user is not found');
            }

            switch ($user['status']) {
                case UserStatusEnum::PENDING->value === $user['status']:
                    return $this->badRequest('user is not verified');
                case UserStatusEnum::BLOCK->value === $user['status']:
                    return $this->badRequest('user is tempory available');
                default:
                    if (! $token = Auth::attempt($payload->toArray())) {
                        return $this->unauthenticated('email or password is not match');
                    }

                    return $this->respondWithToken($token);
            }

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
