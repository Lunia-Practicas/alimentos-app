<?php

namespace App\Http\Controllers;

use App\Services\GenerateDescriptionOpenAIRequest;
use App\Services\GenerateDescriptionOpenAIService;
use Illuminate\Http\Request;

class GenerateDescriptionOpenAIController extends Controller
{
    public function __construct(private readonly GenerateDescriptionOpenAIService $openAIService)
    {

    }

    public function __invoke(Request $request): array
    {
        return $this->openAIService->handle(new GenerateDescriptionOpenAIRequest(
            $request->route('id'),
        ));
    }
}
