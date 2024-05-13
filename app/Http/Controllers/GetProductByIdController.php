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

    public function __invoke(Request $request)
    {
        $product = $this->getProductByIdService->handle(new GetProductByIdRequest(
            $request->route('id')
        ));

        return $product->toJson();
    }
}
