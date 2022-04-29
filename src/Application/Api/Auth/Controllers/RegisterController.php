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
     * @OA\Post(
     *   path="/register",
     *   tags={"Authentication"},
     *   operationId="register",
     *   summary="Register user",
     *   description="Register user",
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         example={
     *           "name": "Your Name",
     *           "email": "your@email.com",
     *           "password": "your-password",
     *           "password_confirmation": "your-password",
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
