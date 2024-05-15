<?php

namespace App\Http\Controllers;

use App\Services\GenerateImageDescriptionRequest;
use App\Services\GenerateImageDescriptionService;
use Illuminate\Http\Request;

class GenerateImageDescriptionController extends Controller
{
    public function __construct(private readonly GenerateImageDescriptionService $generateImageDescriptionService)
    {

    }

    public function __invoke(Request $request)
    {
        return $this->generateImageDescriptionService->handle(new GenerateImageDescriptionRequest(
            $request->route('id')
        ));
    }
}
