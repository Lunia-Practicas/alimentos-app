<?php

namespace App\Services;

use App\Repositories\ImageRepository;

readonly class SaveImageService
{
    public function __construct(private ImageRepository $imageRepository)
    {

    }

    public function handle(SaveImageRequest $param): array
    {
        $data = [
            'product_id' => $param->id,
            'imageCerca' => $param->imageCerca,
            'imageLejos' => $param->imageLejos
        ];

        return $this->imageRepository->create($data);
    }
}
