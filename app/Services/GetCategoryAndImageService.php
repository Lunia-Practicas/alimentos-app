<?php

namespace App\Services;

use App\Repositories\CategoryContentRepository;

readonly class GetCategoryAndImageService
{

    public function __construct(private CategoryContentRepository $categoryContentRepository)
    {

    }

    public function handle(GetCategoryAndImageRequest $request): array
    {

        return $this->categoryContentRepository->getCategoryAndImage();

    }

}
