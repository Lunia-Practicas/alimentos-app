<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\DeleteProductRequest;
use App\Services\DeleteProductService;
use Illuminate\Http\Request;

class DeleteProductController extends Controller
{
    public function __construct(private readonly DeleteProductService $deleteProductService)
    {

    }

    public function __invoke(Request $request)
    {
        $this->deleteProductService->handle(new DeleteProductRequest(
            $request->route('id')
        ));

        return Product::all()->toJson();
    }
}
