<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

class SearchProductService
{
    public function __construct(private ProductRepository $productRepository, private CategoryRepository $categoryRepository)
    {

    }

    public function handle(SearchProductRequest $request)
    {
        $data = [
            'name' => $request->name,
            'origin' => $request->origin,
            'vegan' => $request->vegan,
            'gluten' => $request->gluten,
            'category_id' => $request->category_id,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'min_weight' => $request->min_weight,
            'max_weight' => $request->max_weight,
        ];
        $resultProduct = [];
        $products = $this->productRepository->search($data);

        foreach ($products as $product) {
            $category = $this->categoryRepository->getCategoryById($product->category_id);
            $resultProduct[] = [
                'name' => $product->name,
                'weight' => $product->weight,
                'origin' => $product->origin,
                'price'=> $product->price,
                'vegan' => $product->vegan,
                'gluten'=> $product->gluten,
                'id' => $product->id,
                'category_name' => $category->name,
            ];

        }
        return $resultProduct;
    }
}
