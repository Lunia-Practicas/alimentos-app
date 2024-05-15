<?php

namespace App\Http\Controllers;

use App\Services\GetCategoryContentRequest;
use App\Services\GetCategoryContentService;
use Illuminate\Http\Request;

class GetCategoryContentController extends Controller
{
    public function __construct(private readonly GetCategoryContentService $getCategoryContentService)
    {

    }

    public function __invoke(Request $request)
    {
        return $this->getCategoryContentService->handle(new GetCategoryContentRequest(
            $request->route('id')
        ));
    }
}
