<?php

namespace Domain\User\Actions;

use App\Api\User\Requests\UserCreateRequest;
use Domain\User\Contracts\UserRepositoryInterface;
use Domain\User\Models\User;

class CreateUser
{
    /**
     * CreateUser Constructor
     */
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Create a user
     *
     * @param UserCreateRequest $request
     *
     * @return User
     */
    public function execute(UserCreateRequest $request): User
    {
        return $this->userRepository->create($request->validated());
    }
}
