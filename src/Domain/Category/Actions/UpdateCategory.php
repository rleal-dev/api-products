<?php

namespace Domain\Category\Actions;

use App\Api\Category\Requests\CategoryUpdateRequest;
use Domain\Category\Contracts\CategoryRepositoryInterface;

class UpdateCategory
{
    /**
     * UpdateCategory Constructor
     */
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Update category
     *
     * @param int $id
     * @param CategoryRequest $request
     *
     * @return bool
     */
    public function execute(int $id, CategoryUpdateRequest $request): bool
    {
        return $this->categoryRepository->update($id, $request->validated());
    }
}
