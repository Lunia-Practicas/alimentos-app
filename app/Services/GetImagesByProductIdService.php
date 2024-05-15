<?php

namespace App\Services;

use App\Models\Image;
use App\Repositories\ImageRepository;
use Illuminate\Support\Facades\Storage;

class GetImagesByProductIdService
{
    public function __construct(private ImageRepository $imageRepository)
    {

    }

    public function __handle(GetImagesByProductIdRequest $param)
    {
        $id = $param->id;

        $images = $this->imageRepository->getImagesByIdProduct($id);


       return array_map(function ($image) {
           return [
               'id' => $image['id'],
               'product_id' => $image['product_id'],
               'image' => Storage::url($image['image'])
           ];
       }, $images->toArray());
    }
}
