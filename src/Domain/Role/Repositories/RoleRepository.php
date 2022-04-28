<?php

namespace Domain\Role\Repositories;

use Domain\Role\Contracts\RoleRepositoryInterface;
use Domain\Role\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * RoleRepository Constructor
     */
    public function __construct(
        private Role $role
    ) {
    }

    /**
     * Get all roles
     */
    public function findAll()
    {
        return $this->role->simPlePaginate();
    }

    /**
     * Get role by id.
     *
     * @param int $id
     *
     * @return Role
     */
    public function findById(int $id): Role
    {
        return $this->role->findOrFail($id);
    }

    /**
     * Create a role.
     *
     * @param array $data
     *
     * @return Role
     */
    public function create(array $data): Role
    {
        return $this->role->create($data);
    }

    /**
     * Update existing role.
     *
     * @param int $id
     * @param array $data
     *
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $role = $this->findById($id);

        return $role->update($data);
    }

    /**
     * Delete role by id.
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
