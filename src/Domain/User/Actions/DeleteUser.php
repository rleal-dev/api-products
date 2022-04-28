<?php

namespace Domain\User\Actions;

use Domain\User\Contracts\UserRepositoryInterface;
use Domain\User\Models\User;

class DeleteUser
{
    /**
     * DeleteUser Constructor
     */
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Delete a user by id
     *
     * @param User $user
     *
     * @return bool
     */
    public function execute(int $id): bool
    {
        return $this->userRepository->delete($id);
    }
}
