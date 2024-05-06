<?php

namespace App\Http\Controllers;

use App\Services\SearchProductRequest;
use App\Services\SearchProductService;
use Illuminate\Http\Request;

class SearchProductController extends Controller
{
    public function __construct(private readonly SearchProductService $searchProductService)
    {

    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'origin' => 'nullable|string',
            'vegan' => 'nullable|boolean',
            'gluten' => 'nullable|boolean',
            'category_id' => 'nullable|integer|exists:categories,id',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'min_weight' => 'nullable|numeric|min:0',
            'max_weight' => 'nullable|numeric|min:0',
        ]);

        $products = $this->searchProductService->handle(new SearchProductRequest(
            $request->input('name'),
            $request->input('origin'),
            $request->input('vegan'),
            $request->input('gluten'),
            $request->input('category_id'),
            $request->input('min_price'),
            $request->input('max_price'),
            $request->input('min_weight'),
            $request->input('max_weight'),

        ));


        return $products;
    }
}
