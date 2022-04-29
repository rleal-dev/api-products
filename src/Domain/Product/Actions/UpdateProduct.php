<?php

namespace Domain\Product\Actions;

use App\Api\Product\Requests\ProductUpdateRequest;
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
     * @param ProductUpdateRequest $request
     *
     * @return bool
     */
    public function execute(int $id, ProductUpdateRequest $request): bool
    {
        return $this->productRepository->update($id, $request->validated());
    }
}
