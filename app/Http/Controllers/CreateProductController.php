<?php

namespace App\Http\Controllers;

use App\Services\CreateProductRequest;
use App\Services\CreateProductService;
use Illuminate\Http\Request;

class CreateProductController extends Controller
{
    public function __construct(private readonly CreateProductService $createProductService)
    {

    }

    public function __invoke(Request $request)
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

        $id = auth()->user()->getAuthIdentifier();

        $product = $this->createProductService->handle(new CreateProductRequest(
            $request->input('name'),
            $request->input('category_id'),
            $request->input('weight'),
            $request->input('origin'),
            $request->input('price'),
            $request->input('vegan'),
            $request->input('gluten')
        ), $id);

        $product->fresh();

        return $product->toJson();
    }
}
