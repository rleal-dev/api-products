<?php

namespace App\Api\Auth\Controllers;

use App\Api\Auth\Requests\RegisterRequest;
use App\Api\Base\ApiController;
use Domain\Auth\Actions\Register;
use Throwable;

class RegisterController extends ApiController
{
    /**
     * Perform user register.
     *
     * @param RegisterRequest  $request
     * @param Register  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RegisterRequest $request, Register $action)
    {
        try {
            $token = $action->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on user register!');
        }

        return $this->responseOk('User created successfully!', ['access_token' => $token]);
    }
}
