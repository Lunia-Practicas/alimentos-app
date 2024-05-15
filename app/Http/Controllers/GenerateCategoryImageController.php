<?php

namespace App\Http\Controllers;

use App\Services\GenerateCategoryImageRequest;
use App\Services\GenerateCategoryImageService;
use Illuminate\Http\Request;

class GenerateCategoryImageController extends Controller
{
    public function __construct(private readonly GenerateCategoryImageService $generateCategoryImageService)
    {

    }

    public function __invoke(Request $request): array
    {
        return $this->generateCategoryImageService->handle(new GenerateCategoryImageRequest(
            $request->route('id')
        ));
    }
}
