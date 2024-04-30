<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

readonly class CreateCategoryService
{

    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function handle(CreateCategoryRequest $request)
    {
        $data = [
            'name' => $request->name,
        ];

        return $this->categoryRepository->create($data);
    }

}
