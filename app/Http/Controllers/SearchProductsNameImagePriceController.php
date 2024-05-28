<?php

namespace App\Http\Controllers;

use App\Services\SearchProductsNameImageRequest;
use App\Services\SearchProductsNameImageService;
use Illuminate\Http\Request;

class SearchProductsNameImagePriceController extends Controller
{
    public function __construct(private readonly SearchProductsNameImageService  $searchProductsNameImageService){

    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:products,id',
            'offset' => 'nullable|integer|min:0',
            'limit' => 'nullable|integer|min:1',
            'minPrice' => 'nullable|numeric|min:0',
            'maxPrice' => 'nullable|numeric|min:0',
            'minWeight' => 'nullable|numeric|min:0',
            'maxWeight' => 'nullable|numeric|min:0',
            'vegan' => 'nullable|boolean',
            'gluten' => 'nullable|boolean',
        ]);

        return $this->searchProductsNameImageService->handle(new SearchProductsNameImageRequest(
            $request->input('id'),
            $request->input('offset'),
            $request->input('limit'),
            $request->input('minPrice'),
            $request->input('maxPrice'),
            $request->input('minWeight'),
            $request->input('maxWeight'),
            $request->input('vegan'),
            $request->input('gluten')
        ));
    }

}
