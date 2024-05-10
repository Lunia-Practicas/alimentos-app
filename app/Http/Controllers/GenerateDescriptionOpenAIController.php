<?php

namespace App\Http\Controllers;

use App\Services\GenerateDescriptionOpenAIRequest;
use App\Services\GenerateDescriptionOpenAIService;
use Illuminate\Http\Request;
use OpenAI\Responses\Completions\CreateResponse;

class GenerateDescriptionOpenAIController extends Controller
{
    public function __construct(private readonly GenerateDescriptionOpenAIService $openAIService)
    {

    }

    public function __invoke($id): array
    {
        return $this->openAIService->handle(new GenerateDescriptionOpenAIRequest($id));
    }
}
