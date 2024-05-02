<?php

namespace App\Http\Controllers;

use App\Services\UpdateProductRequest;
use App\Services\UpdateProductService;
use Illuminate\Http\Request;

class UpdateProductController extends Controller
{
    public function __construct(private readonly UpdateProductService $updateProductService)
    {

    }

    public function __invoke($id, Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'weight' => 'required',
            'origin' => 'required',
            'price' => 'required',
            'vegan' => 'required|boolean',
            'gluten'=> 'required|boolean'
        ]);

        $product = $this->updateProductService->handle(new UpdateProductRequest(
            $request->input('name'),
            $request->input('category_id'),
            $request->input('weight'),
            $request->input('origin'),
            $request->input('price'),
            $request->input('vegan'),
            $request->input('gluten')
        ), $id);

        $product->refresh();

        return $product->toJson();
    }
}
