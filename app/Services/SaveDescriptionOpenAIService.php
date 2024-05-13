<?php

namespace App\Services;

use App\Repositories\DescriptionRepository;

class SaveDescriptionOpenAIService
{
    public function __construct(private DescriptionRepository $descriptionRepository)
    {

    }

    public function handle(SaveDescriptionOpenAIRequest $param)
    {
        $data = [
            'product_id' => $param->id,
            'description' => $param->description,
            'title' => $param->title,
        ];

        return $this->descriptionRepository->create($data);
    }
}
