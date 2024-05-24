<?php

namespace App\Services;

use App\Repositories\ImageRepository;
use App\Repositories\ProductContentRepository;
use App\Repositories\ProductRepository;

class GetProductAllDetailsService
{

    public function __construct(private ProductContentRepository $productContentRepository)
    {

    }

    public function handle(GetProductAllDetailsRequest $param)
    {
        $data = [
            'id' => $param->id
        ];

        return $this->productContentRepository->getProductAllDetails($data);




    }
}
