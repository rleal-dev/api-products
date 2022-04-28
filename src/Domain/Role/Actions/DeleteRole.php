<?php

namespace Domain\Role\Actions;

use Domain\Role\Contracts\RoleRepositoryInterface;
use Domain\Role\Models\Role;

class DeleteRole
{
    /**
     * DeleteRole Constructor
     */
    public function __construct(
        private RoleRepositoryInterface $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Delete a role by id
     *
     * @param Role $role
     *
     * @return bool
     */
    public function execute(int $id): bool
    {
        return $this->roleRepository->delete($id);
    }
}
