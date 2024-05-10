<?php

namespace App\Services;

use App\Repositories\ProductRepository;

readonly class GetProductByIdService
{
    public function __construct(private ProductRepository $productRepository)
    {

    }

    public function handle(GetProductByIdRequest $param)
    {
        $id = $param->id;
        return $this->productRepository->getProductById($id);
    }
}
