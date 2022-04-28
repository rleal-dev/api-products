<?php

namespace Domain\User\Actions;

use App\Api\User\Requests\UserRequest;
use Domain\User\Contracts\UserRepositoryInterface;

class UpdateUser
{
    /**
     * UpdateUser Contructor
     */
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Update user
     *
     * @param int $id
     * @param UserRequest $request
     *
     * @return bool
     */
    public function execute(int $id, UserRequest $request): bool
    {
        return $this->userRepository->update($id, $request->validated());
    }
}
