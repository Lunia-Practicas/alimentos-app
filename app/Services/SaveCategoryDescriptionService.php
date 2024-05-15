<?php

namespace App\Services;

use App\Repositories\CategoryContentRepository;

class SaveCategoryDescriptionService
{

    public function __construct(private CategoryContentRepository $categoryContentRepository)
    {
    }

    public function handle(SaveCategoryDescriptionRequest $param)
    {
        $data = [
            'id' => $param->id,
            'description' => $param->description,
            'image' => $param->image,
        ];

        return $this->categoryContentRepository->saveCategoryDescriptionImage($data);
    }
}
