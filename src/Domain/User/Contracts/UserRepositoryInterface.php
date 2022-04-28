<?php

namespace Domain\User\Contracts;

use Domain\User\Models\User;

interface UserRepositoryInterface
{
    public function findAll();

    public function findById(int $id): User;

    public function create(array $data): User;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
