<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

readonly class ListAllCategoriesService
{

    public function __construct(private CategoryRepository $categoryRepository)
    {

    }

    public function handle(ListAllCategoriesRequest $request)
    {
        return $this->categoryRepository->listAll($request);
    }
}
