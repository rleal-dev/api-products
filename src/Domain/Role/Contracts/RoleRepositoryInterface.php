<?php

namespace Domain\Role\Contracts;

use Domain\Role\Models\Role;

interface RoleRepositoryInterface
{
    public function findAll();

    public function findById(int $id): Role;

    public function create(array $data): Role;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
