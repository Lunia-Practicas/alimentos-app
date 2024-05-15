<?php

namespace App\Http\Controllers;

use App\Services\SaveCategoryDescriptionRequest;
use App\Services\SaveCategoryDescriptionService;
use Illuminate\Http\Request;

class SaveCategoryDescriptionImageController extends Controller
{
    public function __construct(private readonly SaveCategoryDescriptionService $saveCategoryDescriptionService)
    {
    }

    public function __invoke(Request $request)
    {
        return $this->saveCategoryDescriptionService->handle(new SaveCategoryDescriptionRequest(
            $request->route('id'),
            $request->input('description'),
            $request->input('image')
        ));
    }
}
