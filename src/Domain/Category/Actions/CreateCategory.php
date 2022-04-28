<?php

namespace Domain\Category\Actions;

use App\Api\Category\Requests\CategoryRequest;
use Domain\Category\Contracts\CategoryRepositoryInterface;
use Domain\Category\Models\Category;

class CreateCategory
{
    /**
     * CreateCategory Constructor
     */
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Create a category
     *
     * @param CategoryRequest $request
     *
     * @return Category
     */
    public function execute(CategoryRequest $request): Category
    {
        return $this->categoryRepository->create($request->validated());
    }
}
