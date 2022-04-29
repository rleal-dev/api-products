<?php

namespace App\Api\Category\Controllers;

use App\Api\Base\ApiController;
use App\Api\Category\Requests\CategoryRequest;
use App\Api\Category\Resources\{CategoryCollection, CategoryResource};
use Domain\Category\Actions\{CreateCategory, DeleteCategory, GetCategory, ListCategories, UpdateCategory};
use Throwable;

class CategoryController extends ApiController
{
    /**
     * Get the category list.
     *
     *  @OA\Get(
     *   path="/categories",
     *   tags={"Category"},
     *   operationId="categoryIndex",
     *   summary="List of categories",
     *   description="List of categories",
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=400, description="Bad Request"),
     *   @OA\Response(response=500, description="Server Error"),
     *   security={{"bearerAuth": {}}},
     * )
     *
     * @param ListCategories $listCategories
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ListCategories $listCategories)
    {
        return new CategoryCollection($listCategories->execute());
    }

    /**
     * Store a new category.
     *
     * @OA\Post(
     *   path="/categories",
     *   tags={"Category"},
     *   operationId="categoryStore",
     *   summary="Create a new category",
     *   description="Create a new category",
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         example={
     *           "description": "Category Name",
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
     * @param CategoryRequest $request
     * @param CreateCategory $createCategory
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request, CreateCategory $createCategory)
    {
        try {
            $category = $createCategory->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on create category!');
        }

        return $this->responseCreated(
            'Category created successfully!',
            new CategoryResource($category)
        );
    }

    /**
     * Get the category by id.
     *
     * @OA\Get(
     *   path="/categories/{id}",
     *   tags={"Category"},
     *   operationId="categoryShow",
     *   summary="Show category",
     *   description="Show category",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Category Id",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=404, description="Resource Not Found"),
     *   security={{"bearerAuth": {}}},
     * )
     *
     * @param int $id
     * @param GetCategory $getCategory
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id, GetCategory $getCategory)
    {
        $category = $getCategory->execute($id);

        return new CategoryResource($category);
    }

    /**
     * Update a category information.
     *
     * @OA\Put(
     *   path="/categories/{id}",
     *   tags={"Category"},
     *   operationId="categoryUpdate",
     *   summary="Update category",
     *   description="Update category",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Category Id",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         example={
     *           "name": "New Category Name",
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
     * @param CategoryRequest  $request
     * @param int $id
     * @param UpdateCategory  $updateCategory
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request, int $id, UpdateCategory $updateCategory)
    {
        try {
            $updateCategory->execute($id, $request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on update category!');
        }

        return $this->responseOk('Category updated successfully!');
    }

    /**
     * Delete a category by id.
     *
     * @OA\Delete(
     *   path="/categories/{id}",
     *   tags={"Category"},
     *   operationId="categoryDestroy",
     *   summary="Destroy category",
     *   description="Destroy category",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Category Id",
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
     * @param DeleteCategory $deleteCategory
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id, DeleteCategory $deleteCategory)
    {
        try {
            $deleteCategory->execute($id);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on delete category!');
        }

        return $this->responseOk('Category deleted successfully!');
    }
}
