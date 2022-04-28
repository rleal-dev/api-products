<?php

namespace Domain\Category\Repositories;

use Domain\Category\Contracts\CategoryRepositoryInterface;
use Domain\Category\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * CategoryRepository Constructor
     */
    public function __construct(
        private Category $category
    ) {
    }

    /**
     * Get all categories
     */
    public function findAll()
    {
        return $this->category->simPlePaginate();
    }

    /**
     * Get category by id.
     *
     * @param int $id
     *
     * @return Category
     */
    public function findById(int $id): Category
    {
        return $this->category->findOrFail($id);
    }

    /**
     * Create a category.
     *
     * @param array $data
     *
     * @return Category
     */
    public function create(array $data): Category
    {
        return $this->category->create($data);
    }

    /**
     * Update existing category.
     *
     * @param int $id
     * @param array $data
     *
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $category = $this->findById($id);

        return $category->update($data);
    }

    /**
     * Delete category by id.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->findById($id)->delete();
    }
}
