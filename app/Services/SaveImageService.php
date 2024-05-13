<?php

namespace App\Services;

use App\Repositories\ImageRepository;

readonly class SaveImageService
{
    public function __construct(private ImageRepository $imageRepository)
    {

    }

    public function handle(SaveImageRequest $param)
    {
        $data = [
            'product_id' => $param->id,
            'image' => $param->image,
        ];

        return $this->imageRepository->create($data);
    }
}
