<?php

namespace Domain\User\Actions;

use Domain\User\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ListUsers
{
    /**
     * ListUsers Constructor
     */
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all users
     *
     * @return Collection
     */
    public function execute()
    {
        return $this->userRepository->findAll();
    }
}
