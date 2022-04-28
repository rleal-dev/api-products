<?php

namespace Domain\User\Actions;

use App\Api\User\Requests\UserRequest;
use Domain\User\Contracts\UserRepositoryInterface;
use Domain\User\Models\User;

class CreateUser
{
    /**
     * CreateUser Contructor
     */
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Create a user
     *
     * @param UserRequest $request
     *
     * @return User
     */
    public function execute(UserRequest $request): User
    {
        return $this->userRepository->create($request->validated());
    }
}
