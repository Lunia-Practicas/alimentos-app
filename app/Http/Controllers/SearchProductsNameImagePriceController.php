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
            'offset' => 'required|integer|min:0',
            'limit' => 'required|integer|min:1',
        ]);

        return $this->searchProductsNameImageService->handle(new SearchProductsNameImageRequest(
            $request->input('id'),
            $request->input('offset'),
            $request->input('limit')
        ));
    }

}
