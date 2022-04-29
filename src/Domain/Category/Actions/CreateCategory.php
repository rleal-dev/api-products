<?php

namespace Domain\Category\Actions;

use App\Api\Category\Requests\CategoryCreateRequest;
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
     * @param CategoryCreateRequest $request
     *
     * @return Category
     */
    public function execute(CategoryCreateRequest $request): Category
    {
        return $this->categoryRepository->create($request->validated());
    }
}
