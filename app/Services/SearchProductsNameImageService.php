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
        ];

        return $this->productContentRepository->searchProductsNameImageLimit($data);
    }
}
