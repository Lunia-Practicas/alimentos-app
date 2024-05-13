<?php

namespace App\Services;

use App\Repositories\ImageRepository;

readonly class GenerateImageService
{
    public function __construct(private ImageRepository $imageRepository)
    {

    }

    public function handle(GenerateImageRequest $param): array
    {
        $id = $param->id;

        return [
            'image' => $this->imageRepository->generateImage($id)
        ];

    }
}
