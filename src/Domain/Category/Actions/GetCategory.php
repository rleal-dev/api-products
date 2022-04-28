<?php

namespace Domain\Category\Actions;

use Domain\Category\Contracts\CategoryRepositoryInterface;
use Domain\Category\Models\Category;

class GetCategory
{
    /**
     * GetCategory Constructor
     */
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get category by id
     *
     * @param int $id
     *
     * @return Category
     */
    public function execute(int $id): Category
    {
        return $this->categoryRepository->findById($id);
    }
}
