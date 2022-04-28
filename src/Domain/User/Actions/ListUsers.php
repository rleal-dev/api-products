<?php

namespace Domain\User\Actions;

use Domain\User\Contracts\UserRepositoryInterface;

class ListUsers
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function execute()
    {
        return $this->userRepository->findAll();
    }
}
