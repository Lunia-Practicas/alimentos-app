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

    public function __invoke($id_product)
    {
        $this->deleteProductService->handle(new DeleteProductRequest(), $id_product);

        return Product::all()->toJson();
    }
}
