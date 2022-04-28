<?php

namespace App\Api\User\Controllers;

use App\Api\Base\ApiController;
use App\Api\User\Requests\UserRequest;
use App\Api\User\Resources\{UserCollection, UserResource};
use Domain\User\Actions\{CreateUser, DeleteUser, GetUser, ListUsers, UpdateUser};

class UserController extends ApiController
{
    /**
     * Get the user list.
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
