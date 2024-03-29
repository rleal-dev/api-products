<?php

namespace Domain\User\Actions;

use App\Api\User\Requests\UserUpdateRequest;
use Domain\User\Contracts\UserRepositoryInterface;

class UpdateUser
{
    /**
     * UpdateUser Constructor
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
     * @param UserUpdateRequest $request
     *
     * @return bool
     */
    public function execute(int $id, UserUpdateRequest $request): bool
    {
        return $this->userRepository->update($id, $request->filtered());
    }
}
