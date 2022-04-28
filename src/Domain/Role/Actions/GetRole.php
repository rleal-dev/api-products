<?php

namespace Domain\Role\Actions;

use Domain\Role\Contracts\RoleRepositoryInterface;
use Domain\Role\Models\Role;

class GetRole
{
    /**
     * GetRole Constructor
     */
    public function __construct(
        private RoleRepositoryInterface $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Get role by id
     *
     * @param int $id
     *
     * @return Role
     */
    public function execute(int $id): Role
    {
        return $this->roleRepository->findById($id);
    }
}
