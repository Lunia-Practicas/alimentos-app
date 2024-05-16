<?php

namespace App\Services;

use App\Repositories\DescriptionRepository;

readonly class GetDescriptionOpenAIService
{
    public function __construct(private DescriptionRepository $descriptionRepository)
    {

    }

    public function handle(GetDescriptionOpenAIRequest $param)
    {
        $id = $param->id;

        $productDescription =  $this->descriptionRepository->getDescription($id);

        if (is_null($productDescription)) {
            return [
                'id' => null,
                'description' => null,
                'title' => null,
            ];
        }

        return $productDescription;
    }
}
