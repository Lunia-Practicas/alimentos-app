<?php

namespace App\Http\Controllers;

use App\Services\ListAllProductsRequest;
use App\Services\ListAllProductsService;
use Illuminate\Http\Request;

class ListAllProductsController extends Controller
{
    public function __construct(private readonly ListAllProductsService $listAllProductsService)
    {

    }

    public function __invoke()
    {
        $products = $this->listAllProductsService->handle(new ListAllProductsRequest());

        return $products->toJson();
    }
}
