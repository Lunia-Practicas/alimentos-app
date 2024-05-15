<?php

namespace App\Services;

use App\Repositories\CategoryContentRepository;

readonly class GenerateCategoryImageService
{
    public function __construct(private CategoryContentRepository $categoryContentRepository)
    {

    }

    public function handle(GenerateCategoryImageRequest $param): array
    {
        $id = $param->id;

        return [
            'image' => $this->categoryContentRepository->generateCategoryImage($id)
        ];
    }
}
