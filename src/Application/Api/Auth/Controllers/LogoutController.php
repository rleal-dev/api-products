<?php

namespace App\Api\Auth\Controllers;

use App\Api\Auth\Requests\LogoutRequest;
use App\Api\Base\ApiController;
use Domain\Auth\Actions\Logout;
use Throwable;

class LogoutController extends ApiController
{
    /**
     * Perform user logout.
     *
     * @OA\Delete(
     *   path="/logout",
     *   tags={"Authentication"},
     *   operationId="logout",
     *   summary="Logout user",
     *   description="Logout user",
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *         @OA\Schema(
     *           example={
     *             "logout_mode": "ALL_TOKENS | CURRENT_TOKEN",
     *           }
     *         )
     *       )
     *   ),
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=400, description="Bad request"),
     *   @OA\Response(response=404, description="Resource Not Found"),
     *   @OA\Response(response=500, description="Server Error"),
     *   security={{"bearerAuth": {}}},
     * )
     *
     * @param LogoutRequest  $request
     * @param Logout  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(LogoutRequest $request, Logout $action)
    {
        try {
            $action->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on user logout!');
        }

        return $this->responseOk('Logout successfully!');
    }
}
