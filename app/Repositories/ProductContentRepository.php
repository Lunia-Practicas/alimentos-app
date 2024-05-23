<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductContent;

class ProductContentRepository
{
    protected $productContent;

    public function __construct(ProductContent $productContent)
    {
        $this->productContent = $productContent;
    }

    public function getProductImage($id)
    {
        return Image::where('product_id', $id)->first();
    }

    public function getProductsNameImagePrice($data)
    {
        $products = Product::query();
        $products->where('category_id','like', "%{$data['id']}%");

        $products = $products->get();

        $resp = [];
        foreach ($products as $product) {
            $image = $this->getProductImage($product->id)->image ?? null;

            $resp[] = [
                'name' => $product->name,
                'product_id' => $product->id,
                'category_id' => $product->category_id,
                'price' => $product->price,
                'image' => $image,
            ];
        }

        return $resp;


    }


}
