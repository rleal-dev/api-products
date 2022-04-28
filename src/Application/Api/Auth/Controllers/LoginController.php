<?php

namespace App\Api\Auth\Controllers;

use App\Api\Auth\Requests\LoginRequest;
use App\Api\Base\ApiController;
use Domain\User\Actions\Login;
use Throwable;

class LoginController extends ApiController
{
    /**
     * Perform user login.
     *
     * @param LoginRequest  $request
     * @param Login  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(LoginRequest $request, Login $action)
    {
        try {
            $token = $action->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on user login!');
        }

        if (! $token) {
            return $this->responseUnauthorized('User or Password incorrect!');
        }

        return $this->responseOk('Login successfully!', ['access_token' => $token]);
    }
}
