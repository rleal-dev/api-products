<?php

namespace Domain\Auth\Actions;

use App\Api\Auth\Requests\LoginRequest;

class Login
{
    /**
     * User Login and register token.
     *
     * @param LoginRequest $request
     *
     * @return bool|string
     */
    public function execute(LoginRequest $request): string
    {
        $credentials = $request->validated();

        if (! auth()->attempt($credentials)) {
            return false;
        }

        return $request->user()->createToken('auth_token')->plainTextToken;
    }
}
