<?php

namespace Domain\Role\Actions;

use App\Api\Role\Requests\RoleCreateRequest;
use Domain\Role\Contracts\RoleRepositoryInterface;
use Domain\Role\Models\Role;

class CreateRole
{
    /**
     * CreateRole Constructor
     */
    public function __construct(
        private RoleRepositoryInterface $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Create a role
     *
     * @param RoleCreateRequest $request
     *
     * @return Role
     */
    public function execute(RoleCreateRequest $request): Role
    {
        return $this->roleRepository->create($request->validated());
    }
}
