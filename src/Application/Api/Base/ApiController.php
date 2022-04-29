<?php

namespace App\Api\Base;

use Illuminate\Http\Response;

/**
 * Class ApiController
 *
 * @OA\Server(
 *   url=L5_SWAGGER_CONST_HOST,
 *   description="Alter Solutions - Products API"
 * )
 *
 * @OA\Info(
 *   title="Alter Solutions - Products API",
 *   version="1.0.0",
 *   description="Alter Solutions - Products API",
 * )
 *
 * @OA\SecurityScheme(
 *   type="http",
 *   scheme="bearer",
 *   securityScheme="bearerAuth"
 * )
 *
 * @OA\Tag(
 *   name="Authentication",
 *   description="API Endpoints of Authentication"
 * )
 *
 * @OA\Tag(
 *   name="User",
 *   description="API Endpoints of Users"
 * )
 *
 * @OA\Tag(
 *   name="Role",
 *   description="API Endpoints of Roles"
 * )
 *
 * @OA\Tag(
 *   name="Category",
 *   description="API Endpoints of Categories"
 * )
 *
 * @OA\Tag(
 *   name="Product",
 *   description="API Endpoints of Campaign Products"
 * )
 */
abstract class ApiController
{
    /**
     * Returns the logged user.
     *
     * @return \App\Models\User
     */
    protected function user()
    {
        return auth()->user();
    }

    /**
     * Returns default response.
     *
     * @param mixed $message
     * @param mixed $data
     * @param mixed $statusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function response($message, $data = [], $statusCode = Response::HTTP_OK)
    {
        $response = [
            'status'  => $statusCode,
            'message' => $message,
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Returns successfull response.
     *
     * @param mixed $message
     * @param mixed $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseOk($message, $data = [])
    {
        return $this->response($message, $data, Response::HTTP_OK);
    }

    /**
     * Returns error response.
     *
     * @param mixed $message
     * @param mixed $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseCreated($message, $data = [])
    {
        return $this->response($message, $data, Response::HTTP_CREATED);
    }

    /**
     * Returns the not found response.
     *
     * @param mixed $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseNotFound($message)
    {
        return $this->response($message, [], Response::HTTP_NOT_FOUND);
    }

    /**
     * Returns the unauthorized response.
     *
     * @param mixed $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseUnauthorized($message)
    {
        return $this->response($message, [], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Returns error response.
     *
     * @param mixed $message
     * @param mixed $data
     * @param mixed $statusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseError($message, $data = [], $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return $this->response($message, $data, $statusCode);
    }
}
