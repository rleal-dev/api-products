<?php

namespace Domain\Product\Actions;

use App\Api\Product\Requests\ProductCreateRequest;
use Domain\Product\Contracts\ProductRepositoryInterface;
use Domain\Product\Models\Product;

class CreateProduct
{
    /**
     * CreateProduct Constructor
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * Create a product
     *
     * @param ProductCreateRequest $request
     *
     * @return Product
     */
    public function execute(ProductCreateRequest $request): Product
    {
        return $this->productRepository->create($request->validated());
    }
}
