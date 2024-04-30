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

    public function __invoke(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:products,name',
            'weight' => 'required',
            'origin' => 'required',
            'price' => 'required',
            'vegan' => 'required|boolean',
            'gluten'=> 'required|boolean'
        ]);

        $product = $this->createProductService->handle(new CreateProductRequest(
            $request->input('name'),
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
