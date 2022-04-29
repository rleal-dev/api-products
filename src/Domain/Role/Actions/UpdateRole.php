<?php

namespace Domain\Role\Actions;

use App\Api\Role\Requests\RoleUpdateRequest;
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
     * @param RoleUpdateRequest $request
     *
     * @return bool
     */
    public function execute(int $id, RoleUpdateRequest $request): bool
    {
        return $this->roleRepository->update($id, $request->validated());
    }
}
