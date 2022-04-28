<?php

namespace Domain\Product\Actions;

use Domain\Product\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ListProducts
{
    /**
     * ListProducts Constructor
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * Get all products
     *
     * @return Collection
     */
    public function execute()
    {
        return $this->productRepository->findAll();
    }
}
