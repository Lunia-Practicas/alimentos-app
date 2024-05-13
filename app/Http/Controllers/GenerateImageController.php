<?php

namespace App\Http\Controllers;

use App\Services\GenerateImageRequest;
use App\Services\GenerateImageService;
use Illuminate\Http\Request;

class GenerateImageController extends Controller
{
    public function __construct(private readonly GenerateImageService  $generateImageService)
    {

    }

    public function __invoke(Request $request): array
    {
        return $this->generateImageService->handle(new GenerateImageRequest(
            $request->route('id')
        ));
    }
}
