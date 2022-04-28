<?php

namespace App\Api\Category\Controllers;

use App\Api\Base\ApiController;
use App\Api\Category\Requests\CategoryRequest;
use App\Api\Category\Resources\{CategoryCollection, CategoryResource};
use Domain\Category\Actions\{CreateCategory, DeleteCategory, GetCategory, ListCategories, UpdateCategory};

class CategoryController extends ApiController
{
    /**
     * Get the category list.
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
