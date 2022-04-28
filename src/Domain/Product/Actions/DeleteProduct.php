<?php

namespace Domain\Product\Actions;

use Domain\Product\Contracts\ProductRepositoryInterface;
use Domain\Product\Models\Product;

class DeleteProduct
{
    /**
     * DeleteProduct Constructor
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * Delete a product by id
     *
     * @param Product $product
     *
     * @return bool
     */
    public function execute(int $id): bool
    {
        return $this->productRepository->delete($id);
    }
}
