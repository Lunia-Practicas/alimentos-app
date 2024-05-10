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
            'created_by' => $request->id,
        ];

        return $this->categoryRepository->create($data);
    }

}
