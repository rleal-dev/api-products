<?php

namespace Domain\User\Actions;

use Domain\User\Contracts\UserRepositoryInterface;
use Domain\User\Models\User;

class GetUser
{
    /**
     * GetUser Constructor
     */
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Get user by id
     *
     * @param int $id
     *
     * @return User
     */
    public function execute(int $id): User
    {
        return $this->userRepository->findById($id);
    }
}
