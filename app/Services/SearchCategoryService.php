<?php

namespace App\Services;

use App\Repositories\CategoryContentRepository;

readonly class SearchCategoryService
{

    public function __construct(private CategoryContentRepository $categoryContentRepository)
    {

    }

    public function handle(SearchCategoryRequest $param)
    {
        $data = [
            'name' => $param->name
        ];

        return $this->categoryContentRepository->search($data);
    }
}
