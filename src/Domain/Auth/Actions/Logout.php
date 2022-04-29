<?php

namespace Domain\Auth\Actions;

use App\Api\Auth\Requests\LogoutRequest;
use Domain\Auth\Enums\LogoutType;

class Logout
{
    /**
     * User Logout.
     *
     * @param LogoutRequest $request
     *
     * @return bool
     */
    public function execute(LogoutRequest $request): bool
    {
        if ($request->logout_mode == LogoutType::CURRENT_TOKEN) {
            return $request->user()->currentAccessToken()->delete();
        }

        return $request->user()->tokens()->delete();
    }
}
