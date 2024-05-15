<?php

namespace App\Services;

use App\Repositories\CategoryContentRepository;
use App\Repositories\DescriptionRepository;

readonly class GenerateCategoryDescriptionService
{

    public function __construct(private CategoryContentRepository $categoryContentRepository)
    {
    }

    public function handle(GenerateCategoryDescriptionRequest $param): array
    {
        $id = $param->id;

        return [
            'description' => $this->categoryContentRepository->generateCategoryDescription($id)
        ];
    }
}
