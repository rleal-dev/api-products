<?php

namespace Domain\Role\Actions;

use App\Api\Role\Requests\RoleRequest;
use Domain\Role\Contracts\RoleRepositoryInterface;

class UpdateRole
{
    /**
     * UpdateRole Constructor
     */
    public function __construct(
        private RoleRepositoryInterface $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Update role
     *
     * @param int $id
     * @param RoleRequest $request
     *
     * @return bool
     */
    public function execute(int $id, RoleRequest $request): bool
    {
        return $this->roleRepository->update($id, $request->validated());
    }
}
