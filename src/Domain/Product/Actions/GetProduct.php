<?php

namespace Domain\Product\Actions;

use Domain\Product\Contracts\ProductRepositoryInterface;
use Domain\Product\Models\Product;

class GetProduct
{
    /**
     * GetProduct Constructor
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * Get product by id
     *
     * @param int $id
     *
     * @return Product
     */
    public function execute(int $id): Product
    {
        return $this->productRepository->findById($id);
    }
}
