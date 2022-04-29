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
     * @OA\Get(
     *   path="/products",
     *   tags={"Product"},
     *   operationId="productIndex",
     *   summary="List of products",
     *   description="List of products",
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=400, description="Bad Request"),
     *   @OA\Response(response=500, description="Server Error"),
     *   security={{"bearerAuth": {}}},
     * )
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
     * @OA\Post(
     *   path="/products",
     *   tags={"Product"},
     *   operationId="productStore",
     *   summary="Create a new product",
     *   description="Create a new product",
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         example={
     *           "description": "Product Name",
     *           "category_id": 1,
     *           "dimensions": "100X100",
     *           "code": "ABC12345",
     *           "reference": "XYZ54321",
     *           "quantity_stock": 10,
     *           "price": 100.00,
     *           "is_active": true,
     *         }
     *       )
     *     )
     *   ),
     *   @OA\Response(response=201, description="Created Successful"),
     *   @OA\Response(response=400, description="Bad Request"),
     *   @OA\Response(response=422, description="Unprocessable Entity"),
     *   @OA\Response(response=500, description="Server Error"),
     *   security={{"bearerAuth": {}}},
     * )
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
     * @OA\Get(
     *   path="/products/{id}",
     *   tags={"Product"},
     *   operationId="productShow",
     *   summary="Show product",
     *   description="Show product",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Product Id",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=404, description="Resource Not Found"),
     *   security={{"bearerAuth": {}}},
     * )
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
     * @OA\Put(
     *   path="/products/{id}",
     *   tags={"Product"},
     *   operationId="productUpdate",
     *   summary="Update product",
     *   description="Update product",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Product Id",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         example={
     *           "name": "New Product Name",
     *           "quantity_stock": 10,
     *           "price": 120.00,
     *           "is_active": true,
     *          }
     *        )
     *     )
     *   ),
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=404, description="Resource Not Found"),
     *   @OA\Response(response=422, description="Unprocessable Entity"),
     *   @OA\Response(response=500, description="Server Error"),
     *   security={{"bearerAuth": {}}},
     * )
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
     * @OA\Delete(
     *   path="/products/{id}",
     *   tags={"Product"},
     *   operationId="productDestroy",
     *   summary="Destroy product",
     *   description="Destroy product",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Product Id",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=404, description="Resource Not Found"),
     *   @OA\Response(response=422, description="Unprocessable Entity"),
     *   @OA\Response(response=500, description="Server Error"),
     *   security={{"bearerAuth": {}}},
     * )
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
