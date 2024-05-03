<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\GetCategoryByIdRequest;
use App\Services\GetCategoryByIdService;
use Illuminate\Http\Request;

class GetCategoryByIdController extends Controller
{
    public function __construct(private readonly GetCategoryByIdService $getCategoryByIdService)
    {

    }

    public function __invoke($id)
    {
        $category = $this->getCategoryByIdService->handle(new GetCategoryByIdRequest(), $id);

        return $category->toJson();
    }
}
