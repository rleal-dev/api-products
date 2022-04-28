<?php

namespace Domain\Product\Actions;

use App\Api\Product\Requests\ProductRequest;
use Domain\Product\Contracts\ProductRepositoryInterface;

class UpdateProduct
{
    /**
     * UpdateProduct Constructor
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * Update product
     *
     * @param int $id
     * @param ProductRequest $request
     *
     * @return bool
     */
    public function execute(int $id, ProductRequest $request): bool
    {
        return $this->productRepository->update($id, $request->validated());
    }
}
