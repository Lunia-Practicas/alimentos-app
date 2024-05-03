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
        ]);

        $products = $this->searchProductService->handle(new SearchProductRequest(
            $request->input('name'),
            $request->input('origin'),
            $request->input('vegan'),
            $request->input('gluten'),
        ));


        return $products;
    }
}
