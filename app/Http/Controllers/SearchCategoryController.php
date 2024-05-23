<?php

namespace App\Http\Controllers;

use App\Services\SearchCategoryRequest;
use App\Services\SearchCategoryService;
use Illuminate\Http\Request;

class SearchCategoryController extends Controller
{
    public function __construct(private readonly SearchCategoryService $searchCategoryService)
    {
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
        ]);

        return $this->searchCategoryService->handle(new SearchCategoryRequest(
            $request->input('name'),
        ));
    }
}
