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
