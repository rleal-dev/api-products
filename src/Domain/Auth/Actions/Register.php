<?php

namespace Domain\Auth\Actions;

use App\Api\Auth\Requests\RegisterRequest;
use Domain\User\Contracts\UserRepositoryInterface;

class Register
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
     * Create user account.
     *
     * @param RegisterRequest $request
     *
     * @return string
     */
    public function execute(RegisterRequest $request): string
    {
        $user = $this->userRepository->create($request->validated());

        return $user->createToken('auth_token')->plainTextToken;
    }
}
