<?php

namespace App\Services;

use App\Repositories\ProductRepository;

readonly class ListAllProductsService
{

    public function __construct(private ProductRepository $productRepository)
    {

    }

    public function handle(ListAllProductsRequest $param)
    {
        return $this->productRepository->listAll();
    }
}
