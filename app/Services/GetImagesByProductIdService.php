<?php

namespace App\Services;

use App\Repositories\ImageRepository;

class GetImagesByProductIdService
{
    public function __construct(private ImageRepository $imageRepository)
    {

    }

    public function __handle(GetImagesByProductIdRequest $param)
    {
        $id = $param->id;

        return $this->imageRepository->getImagesByIdProduct($id);
    }
}
