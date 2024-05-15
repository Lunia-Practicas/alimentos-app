<?php

namespace App\Services;

use App\Repositories\DescriptionRepository;

readonly class GenerateCategoryDescriptionService
{

    public function __construct(private DescriptionRepository $descriptionRepository)
    {
    }

    public function handle(GenerateCategoryDescriptionRequest $param)
    {
        $id = $param->id;

        return [
            'description' => $this->descriptionRepository->generateCategoryDescription($id)
        ];
    }
}
