<?php

namespace App\Api\User\Controllers;

use App\Api\Base\ApiController;
use App\Api\User\Requests\UserRequest;
use App\Api\User\Resources\{UserCollection, UserResource};
use Domain\User\Actions\{CreateUser, DeleteUser, GetUser, ListUsers, UpdateUser};
use Throwable;

class UserController extends ApiController
{
    /**
     * Get the user list.
     *
     * @OA\Get(
     *   path="/users",
     *   tags={"User"},
     *   operationId="userIndex",
     *   summary="List of users",
     *   description="List of users",
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=400, description="Bad Request"),
     *   @OA\Response(response=500, description="Server Error"),
     *   security={{"bearerAuth": {}}},
     * )
     *
     * @param ListUsers $listUsers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ListUsers $listUsers)
    {
        return new UserCollection($listUsers->execute());
    }

    /**
     * Store a new user.
     *
     * @OA\Post(
     *   path="/users",
     *   tags={"User"},
     *   operationId="userStore",
     *   summary="Create a new user",
     *   description="Create a new user",
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         example={
     *           "name": "User Name",
     *           "email": "user@email.com",
     *           "password": "user-password",
     *           "password_confirmation": "user-password",
     *           "is_active": true,
     *         }
     *       )
     *     )
     *   ),
     *   @OA\Response(response=201, description="Created Successful"),
     *   @OA\Response(response=400, description="Bad Request"),
     *   @OA\Response(response=422, description="Unprocessable Entity"),
     *   @OA\Response(response=500, description="Server Error"),
     *   security={{"bearerAuth": {}}},
     * )
     *
     * @param UserRequest $request
     * @param CreateUser $createUser
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request, CreateUser $createUser)
    {
        try {
            $user = $createUser->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on create user!');
        }

        return $this->responseCreated(
            'User created successfully!',
            new UserResource($user)
        );
    }

    /**
     * Get the user by id.
     *
     * @OA\Get(
     *   path="/users/{id}",
     *   tags={"User"},
     *   operationId="userShow",
     *   summary="Show user",
     *   description="Show user",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="User Id",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=404, description="Resource Not Found"),
     *   security={{"bearerAuth": {}}},
     * )
     *
     * @param int $id
     * @param GetUser $getUser
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id, GetUser $getUser)
    {
        $user = $getUser->execute($id);

        return new UserResource($user);
    }

    /**
     * Update a user information.
     *
     * @OA\Put(
     *   path="/users/{id}",
     *   tags={"User"},
     *   operationId="userUpdate",
     *   summary="Update user",
     *   description="Update user",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="User Id",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         example={
     *           "name": "New User Name",
     *          }
     *        )
     *     )
     *   ),
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=404, description="Resource Not Found"),
     *   @OA\Response(response=422, description="Unprocessable Entity"),
     *   @OA\Response(response=500, description="Server Error"),
     *   security={{"bearerAuth": {}}},
     * )
     *
     * @param UserRequest  $request
     * @param int $id
     * @param UpdateUser  $updateUser
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, int $id, UpdateUser $updateUser)
    {
        try {
            $updateUser->execute($id, $request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on update user!');
        }

        return $this->responseOk('User updated successfully!');
    }

    /**
     * Delete a user by id.
     *
     * @OA\Delete(
     *   path="/users/{id}",
     *   tags={"User"},
     *   operationId="userDestroy",
     *   summary="Destroy user",
     *   description="Destroy user",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="User Id",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=404, description="Resource Not Found"),
     *   @OA\Response(response=422, description="Unprocessable Entity"),
     *   @OA\Response(response=500, description="Server Error"),
     *   security={{"bearerAuth": {}}},
     * )
     *
     * @param int $id
     * @param DeleteUser $deleteUser
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id, DeleteUser $deleteUser)
    {
        try {
            $deleteUser->execute($id);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on delete user!');
        }

        return $this->responseOk('User deleted successfully!');
    }
}
