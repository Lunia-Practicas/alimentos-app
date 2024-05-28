<?php

namespace App\Services;

use App\Repositories\ProductContentRepository;

readonly class SearchProductsNameImageService
{

    public function __construct(private ProductContentRepository $productContentRepository)
    {
    }

    public function handle(SearchProductsNameImageRequest $param)
    {
        $data = [
            'id' => $param->id,
            'offset' => $param->offset,
            'limit' => $param->limit,
            'minPrice' => $param->minPrice,
            'maxPrice' => $param->maxPrice,
            'minWeight' => $param->minWeight,
            'maxWeight' => $param->maxWeight,
            'vegan' => $param->vegan,
            'gluten' => $param->gluten,
        ];

        return $this->productContentRepository->searchProductsNameImageLimit($data);
    }
}
