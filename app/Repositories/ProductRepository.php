<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Services\DeleteProductRequest;
use App\Services\ListAllProductsByCategoryIdRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function create($data)
    {
        $product = Product::create($data);

        $product->fresh();
        return $product;
    }

    public function delete($param, $id_product)
    {
        $product = Product::findOrFail($id_product);
        $product->delete();
    }

    public function listAll()
    {
        return Product::all();
    }

    public function listAllByCategoryId(ListAllProductsByCategoryIdRequest $param, $id)
    {
        $category = Category::findOrFail($id);

        $products = $category->products()->get();

        return $products;
    }

    public function update($data, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }
}
