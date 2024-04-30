<?php

namespace App\Http\Controllers;

use App\Services\CreateCategoryRequest;
use App\Services\CreateCategoryService;
use Illuminate\Http\Request;

class CreateCategoryController extends Controller
{
    public function __construct(private readonly CreateCategoryService $createCategoryService)
    {

    }

    public function __invoke(Request $request)
    {
       $request->validate([
           'name' => 'required|unique:categories',
       ]);

       $category = $this->createCategoryService->handle(new CreateCategoryRequest(
           $request->input('name'),
       ));

       $category->fresh();

       return $category->toJson();
    }
}
