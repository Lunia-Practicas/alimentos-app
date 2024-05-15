<?php

namespace App\Http\Controllers;

use App\Services\GenerateCategoryDescriptionRequest;
use App\Services\GenerateCategoryDescriptionService;
use Illuminate\Http\Request;

class GenerateCategoryDescriptionController extends Controller
{
    public function __construct(private readonly GenerateCategoryDescriptionService $generateCategoryDescriptionService)
    {

    }

    public function __invoke(Request $request): array
    {
        return $this->generateCategoryDescriptionService->handle(new GenerateCategoryDescriptionRequest(
            $request->route('id'),
        ));
    }
}
