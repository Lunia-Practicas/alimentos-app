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

    public function __invoke(Request $request)
    {
        $category = $this->getCategoryByIdService->handle(new GetCategoryByIdRequest(
            $request->route('id')
        ));

        return $category->toJson();
    }
}
