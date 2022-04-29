<?php

namespace Domain\User\Repositories;

use Domain\User\Contracts\UserRepositoryInterface;
use Domain\User\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    /**
     * UserRepository Constructor
     */
    public function __construct(
        private User $user
    ) {
    }

    /**
     * Get all users
     */
    public function findAll()
    {
        return $this->user->simPlePaginate();
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
        return $this->user->findOrFail($id);
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
        return DB::transaction(function() use ($data) {
            $user = $this->user->create($data);

            if (isset($data['roles'])) {
                $user->roles()->attach($data['roles']);
            }

            return $user;
        });
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
        return DB::transaction(function() use ($id, $data) {
            $user = $this->findById($id);

            if (isset($data['roles'])) {
                $user->roles()->sync($data['roles']);
            }

            return $user->update($data);
        });
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
