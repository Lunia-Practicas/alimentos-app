<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

readonly class CreateCategoryService
{

    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function handle(CreateCategoryRequest $request, $id)
    {
        $data = [
            'name' => $request->name,
            'user_created' => $id,
            'user_updated' => $id,
        ];

        return $this->categoryRepository->create($data);
    }

}
