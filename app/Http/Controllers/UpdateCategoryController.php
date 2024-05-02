<?php

namespace App\Http\Controllers;

use App\Services\UpdateCategoryRequest;
use App\Services\UpdateCategoryService;
use Illuminate\Http\Request;

class UpdateCategoryController extends Controller
{
    public function __construct(private readonly UpdateCategoryService $updateCategoryService)
    {

    }

    public function __invoke($id, Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $category = $this->updateCategoryService->handle(new UpdateCategoryRequest(
            $request->input('name'),
        ), $id);

        $category->fresh();

        return $category->toJson();
    }
}
