<?php

namespace Domain\Role\Actions;

use Domain\Role\Contracts\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ListRoles
{
    /**
     * ListRoles Constructor
     */
    public function __construct(
        private RoleRepositoryInterface $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Get all roles
     *
     * @return Collection
     */
    public function execute()
    {
        return $this->roleRepository->findAll();
    }
}
