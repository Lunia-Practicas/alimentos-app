<?php

namespace App\Http\Controllers;

use App\Services\GetProductByIdRequest;
use App\Services\GetProductByIdService;
use Illuminate\Http\Request;

class GetProductByIdController extends Controller
{
    public function __construct(private readonly GetProductByIdService $getProductByIdService)
    {

    }

    public function __invoke($id)
    {
        $product = $this->getProductByIdService->handle(new GetProductByIdRequest($id));

        return $product->toJson();
    }
}
