<?php

namespace Domain\Category\Actions;

use Domain\Category\Contracts\CategoryRepositoryInterface;
use Domain\Category\Models\Category;

class DeleteCategory
{
    /**
     * DeleteCategory Constructor
     */
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Delete a category by id
     *
     * @param Category $category
     *
     * @return bool
     */
    public function execute(int $id): bool
    {
        return $this->categoryRepository->delete($id);
    }
}
