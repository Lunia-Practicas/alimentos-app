<?php

namespace App\Services;

use App\Repositories\ImageRepository;

readonly class GenerateImageService
{
    public function __construct(private ImageRepository $imageRepository)
    {

    }

    public function handle(GenerateImageRequest $param, string $prompt)
    {
        $id = $param->id;


        return $this->imageRepository->generateImage($id, $prompt);


    }
}
