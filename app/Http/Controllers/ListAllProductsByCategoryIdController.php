<?php

namespace App\Http\Controllers;

use App\Services\ListAllProductsByCategoryIdRequest;
use App\Services\ListAllProductsByCategoryIdService;
use Illuminate\Http\Request;

class ListAllProductsByCategoryIdController extends Controller
{
    public function __construct(private readonly ListAllProductsByCategoryIdService $listAllProductsByCategoryIdService)
    {

    }

    public function __invoke($id)
    {
        $products = $this->listAllProductsByCategoryIdService->handle(new ListAllProductsByCategoryIdRequest($id));

        return $products->toJson();
    }
}
