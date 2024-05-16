<?php

namespace App\Http\Controllers;

use App\Services\UpdateCategoryContentRequest;
use App\Services\UpdateCategoryContentService;
use Illuminate\Http\Request;

class UpdateCategoryContentController extends Controller
{
    public function __construct(private readonly UpdateCategoryContentService $updateCategoryContentService)
    {

    }

    public function __invoke(Request $request)
    {
        return $this->updateCategoryContentService->handle(new UpdateCategoryContentRequest(
            $request->route('id'),
            $request->input('description'),
            $request->input('image')
        ));

    }
}
