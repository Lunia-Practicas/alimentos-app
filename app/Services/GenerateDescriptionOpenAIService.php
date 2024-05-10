<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\DescriptionRepository;
use OpenAI;
use OpenAI\Responses\Completions\CreateResponse;

readonly class GenerateDescriptionOpenAIService
{
    public function __construct(private DescriptionRepository $descriptionRepository)
    {

    }

    public function handle(GenerateDescriptionOpenAIRequest $param): array
    {
        $id = $param->id;

        return[
            'description' => $this->descriptionRepository->generate($id)
        ];

    }
}
