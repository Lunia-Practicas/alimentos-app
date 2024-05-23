<?php

namespace App\Http\Controllers;

use App\Services\GetProductsNameImagePriceRequest;
use App\Services\GetProductsNameImagePriceService;
use Illuminate\Http\Request;

class GetProductsNameImagePriceController extends Controller
{
    public function __construct(private readonly GetProductsNameImagePriceService $searchProductNameImagePriceService)
    {

    }

    public function __invoke(Request $request)
    {

        return $this->searchProductNameImagePriceService->handle(new GetProductsNameImagePriceRequest(
            $request->route('id')
        ));
    }
}
