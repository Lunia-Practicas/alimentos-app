<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\DeleteCategoryRequest;
use App\Services\DeleteCategoryService;
use Illuminate\Http\Request;

class DeleteCategoryController extends Controller
{
    public function __construct(private readonly DeleteCategoryService $deleteCategoryService)
    {

    }

    public function __invoke($id)
    {
        $this->deleteCategoryService->handle(new DeleteCategoryRequest(), $id);

        return Category::all()->toJson();
    }

}
