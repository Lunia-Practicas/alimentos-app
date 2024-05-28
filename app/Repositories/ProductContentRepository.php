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

        return $this->createResp($products);

    }

    public function searchProductsNameImageLimit($data)
    {
        $products = Product::query();
        $products->where('category_id','like', "%{$data['id']}%");

        if (!is_null($data['minPrice'])) {
            $products->where('price','>=', $data['minPrice']);
        }
        if (!is_null($data['maxPrice'])) {
            $products->where('price','<=', $data['maxPrice']);
        }
        if (!is_null($data['minWeight'])) {
            $products->where('weight','>=', $data['minWeight']);
        }
        if (!is_null($data['maxWeight'])) {
            $products->where('weight','<=', $data['maxWeight']);
        }

        if (!is_null($data['vegan'])) {
            $products->where('vegan', $data['vegan']);
        }

        if (!is_null($data['gluten'])) {
            $products->where('gluten', $data['gluten']);
        }

        $products->offset($data['offset'])->limit($data['limit']);
        $products->get();
        return $this->createResp($products);
    }

    public function getProductAllDetails($data)
    {
        $product = Product::findOrFail($data['id']);

        $productContent = ProductContent::where('product_id', $product->id)->first();

        $imagesProduct = Image::where('product_id', $product->id)->get();

        return [
            'id' => $product->id,
            'title' => $productContent->title,
            'category_id' => $product->category_id,
            'origin' => $product->origin,
            'price' => $product->price,
            'weight' => $product->weight,
            'images' => $imagesProduct,
            'description' => $productContent->description,
            'gluten' => $product->gluten,
            'vegan' => $product->vegan,
        ];

    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $products
     * @return array
     */
    public function createResp(\Illuminate\Database\Eloquent\Builder $products): array
    {
        $products = $products->get();

        $resp = [];
        foreach ($products as $product) {
            $image = $this->getProductImage($product->id)->image ?? null;
            if ($image != null) {
                $resp[] = [
                    'name' => $product->name,
                    'product_id' => $product->id,
                    'category_id' => $product->category_id,
                    'price' => $product->price,
                    'image' => $image,
                    'weight' => $product->weight,
                    'gluten' => $product->gluten,
                    'vegan' => $product->vegan,
                ];
            }
        }

        return $resp;
    }


}
