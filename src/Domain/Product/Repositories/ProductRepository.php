<?php

namespace Domain\Product\Repositories;

use Domain\Product\Contracts\ProductRepositoryInterface;
use Domain\Product\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * ProductRepository Constructor
     */
    public function __construct(
        private Product $product
    ) {
    }

    /**
     * Get all products
     */
    public function findAll()
    {
        return $this->product->simPlePaginate();
    }

    /**
     * Get product by id.
     *
     * @param int $id
     *
     * @return Product
     */
    public function findById(int $id): Product
    {
        return $this->product->findOrFail($id);
    }

    /**
     * Create a product.
     *
     * @param array $data
     *
     * @return Product
     */
    public function create(array $data): Product
    {
        return $this->product->create($data);
    }

    /**
     * Update existing product.
     *
     * @param int $id
     * @param array $data
     *
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $product = $this->findById($id);

        return $product->update($data);
    }

    /**
     * Delete product by id.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->findById($id)->delete();
    }
}
