<?php

namespace App\Api\Product\Controllers;

use App\Api\Base\ApiController;
use App\Api\Product\Requests\ProductRequest;
use App\Api\Product\Resources\{ProductCollection, ProductResource};
use Domain\Product\Actions\{CreateProduct, DeleteProduct, GetProduct, ListProducts, UpdateProduct};
use Throwable;

class ProductController extends ApiController
{
    /**
     * Get the product list.
     *
     * @param ListProducts $listProducts
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ListProducts $listProducts)
    {
        return new ProductCollection($listProducts->execute());
    }

    /**
     * Store a new product.
     *
     * @param ProductRequest $request
     * @param CreateProduct $createProduct
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request, CreateProduct $createProduct)
    {
        try {
            $product = $createProduct->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on create product!');
        }

        return $this->responseCreated(
            'Product created successfully!',
            new ProductResource($product)
        );
    }

    /**
     * Get the product by id.
     *
     * @param int $id
     * @param GetProduct $getProduct
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id, GetProduct $getProduct)
    {
        $product = $getProduct->execute($id);

        return new ProductResource($product);
    }

    /**
     * Update a product information.
     *
     * @param ProductRequest  $request
     * @param int $id
     * @param UpdateProduct  $updateProduct
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, int $id, UpdateProduct $updateProduct)
    {
        try {
            $updateProduct->execute($id, $request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on update product!');
        }

        return $this->responseOk('Product updated successfully!');
    }

    /**
     * Delete a product by id.
     *
     * @param int $id
     * @param DeleteProduct $deleteProduct
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id, DeleteProduct $deleteProduct)
    {
        try {
            $deleteProduct->execute($id);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on delete product!');
        }

        return $this->responseOk('Product deleted successfully!');
    }
}
