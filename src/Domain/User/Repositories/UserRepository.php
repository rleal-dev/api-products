<?php

namespace Domain\User\Repositories;

use Domain\User\Contracts\UserRepositoryInterface;
use Domain\User\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * UserRepository contructor
     */
    public function __construct(
        private User $model
    ) {
    }

    /**
     * Get all users
     */
    public function findAll()
    {
        return $this->model->simPlePaginate();
    }

    /**
     * Get user by id.
     *
     * @param int $id
     *
     * @return User
     */
    public function findById(int $id): User
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create a user.
     *
     * @param array $data
     *
     * @return User
     */
    public function create(array $data): User
    {
        return $this->model->create($data);
    }

    /**
     * Update existing user.
     *
     * @param int $id
     * @param array $data
     *
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $user = $this->findById($id);

        return $user->update($data);
    }

    /**
     * Delete user by id.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->findById($id)->delete();
    }
}
