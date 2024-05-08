<?php

namespace App\Services;

use App\Repositories\ProductRepository;

readonly class CreateProductService
{

    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function handle(CreateProductRequest $request, $id)
    {
        $data = [
            'name' => $request->name,
            'weight' => $request->weight,
            'origin' => $request->origin,
            'price' => $request->price,
            'vegan' => $request->vegan,
            'gluten' => $request->gluten,
            'category_id' => $request->category_id,
            'created_by' => $id,
            'updated_by' => $id,
        ];

        return $this->productRepository->create($data);
    }
}
