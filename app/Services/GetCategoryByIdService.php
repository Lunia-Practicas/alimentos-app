<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

readonly class GetCategoryByIdService
{
    public function __construct(private CategoryRepository $categoryRepository)
    {

    }

    public function handle(GetCategoryByIdRequest $param)
    {
        $id = $param->id;

        return $this->categoryRepository->getCategoryById($id);
    }
}
