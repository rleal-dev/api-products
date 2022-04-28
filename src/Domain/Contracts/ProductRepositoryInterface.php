<?php

namespace Domain\Product\Contracts;

use Domain\Product\Models\Product;

interface ProductRepositoryInterface
{
    public function findAll();

    public function findById(int $id): Product;

    public function create(array $data): Product;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
