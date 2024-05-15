<?php

namespace App\Services;

use App\Repositories\ImageRepository;

class GenerateImageDescriptionService
{
    public function __construct(private ImageRepository $imageRepository)
    {

    }

    public function handle(GenerateImageDescriptionRequest $param)
    {
        $data = [
            'id' => $param->id,
        ];

        return [
            'image' =>$this->imageRepository->generateImageDescription($data)
        ];
    }
}
