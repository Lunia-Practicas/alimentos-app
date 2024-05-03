<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Services\DeleteProductRequest;
use App\Services\ListAllProductsByCategoryIdRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use function PHPUnit\Framework\isNull;

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

    public function delete($id_product)
    {
        $product = Product::findOrFail($id_product);
        $product->delete();
    }

    public function listAll()
    {
        return Product::all();
    }

    public function listAllByCategoryId($id)
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

    public function getProductById($id)
    {
        return Product::findOrFail($id);
    }

    public function search($request)
    {
        $products = Product::query();

        if (!is_null($request['name'])) {
            $products->where('name', 'LIKE', "%{$request['name']}%");
        }

        if (!is_null($request['origin'])) {
            $products->where('origin', 'LIKE', "%{$request['origin']}%");
        }

        if (!is_null($request['vegan'])) {
            $products->where('vegan', $request['vegan']);
        }

        if (!is_null($request['gluten'])) {
            $products->where('gluten', $request['gluten']);
        }

        return $products->get();
    }
}
