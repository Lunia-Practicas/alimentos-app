<?php

namespace App\Services;

use App\Repositories\DescriptionRepository;

readonly class GenerateTitleService
{

    public function __construct(private DescriptionRepository $descriptionRepository)
    {

    }

    public function handle(GenerateTitleRequest $param): array
    {
        $id = $param->id;

        return [
            'title' => $this->descriptionRepository->generateTitle($id)
        ];
    }
}
