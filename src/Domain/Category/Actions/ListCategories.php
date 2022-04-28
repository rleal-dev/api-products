<?php

namespace Domain\Category\Actions;

use Domain\Category\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ListCategories
{
    /**
     * ListCategories Constructor
     */
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get all categories
     *
     * @return Collection
     */
    public function execute()
    {
        return $this->categoryRepository->findAll();
    }
}
