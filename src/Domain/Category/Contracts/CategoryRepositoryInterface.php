<?php

namespace Domain\Category\Contracts;

use Domain\Category\Models\Category;

interface CategoryRepositoryInterface
{
    public function findAll();

    public function findById(int $id): Category;

    public function create(array $data): Category;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
