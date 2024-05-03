<?php

namespace App\Services;

use App\Repositories\ProductRepository;

readonly class GetProductByIdService
{
    public function __construct(private ProductRepository $productRepository)
    {

    }

    public function handle($param, $id)
    {
        return $this->productRepository->getProductById($id);
    }
}
