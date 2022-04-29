<?php

namespace App\Api\Auth\Controllers;

use App\Api\Auth\Requests\LoginRequest;
use App\Api\Base\ApiController;
use Domain\Auth\Actions\Login;
use Throwable;

class LoginController extends ApiController
{
    /**
     * Perform user login.
     *
     * @OA\Post(
     *   path="/login",
     *   tags={"Authentication"},
     *   operationId="login",
     *   summary="Login user",
     *   description="Login user",
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         example={
     *           "email": "your@email.com",
     *           "password": "your-password",
     *         }
     *       )
     *     )
     *   ),
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=422, description="Unprocessable Entity"),
     *   @OA\Response(response=500, description="Server Error")
     * )
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
