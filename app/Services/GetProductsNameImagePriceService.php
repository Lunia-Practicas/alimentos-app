<?php

namespace App\Services;

use App\Repositories\ProductContentRepository;

readonly class GetProductsNameImagePriceService
{

    public function __construct(private ProductContentRepository $productContentRepository)
    {

    }

    public function handle(GetProductsNameImagePriceRequest $param)
    {
        $data = [
            'id' => $param->id,
        ];

        return $this->productContentRepository->getProductsNameImagePrice($data);
    }
}
