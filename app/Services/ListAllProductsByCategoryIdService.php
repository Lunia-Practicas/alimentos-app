<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ListAllProductsByCategoryIdService
{
    public function __construct(private ProductRepository $productRepository)
    {

    }

    public function handle(ListAllProductsByCategoryIdRequest $param)
    {
        $id = $param->id;
        return $this->productRepository->listAllByCategoryId($id);
    }
}
