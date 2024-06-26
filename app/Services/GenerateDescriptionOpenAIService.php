<?php

namespace App\Services;

use App\Repositories\DescriptionRepository;

readonly class GenerateDescriptionOpenAIService
{

    public function __construct(private DescriptionRepository $descriptionRepository)
    {

    }

    public function handle(GenerateDescriptionOpenAIRequest $param): array
    {
        $id = $param->id;

        return [
            'description' => $this->descriptionRepository->generate($id)
        ];
    }
}
